<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="../CSS/index.css" />

    <link rel="stylesheet" href="../CSS/signup.css" />
    <link href="../IMG/Logo-icon.png" rel="icon">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="../Scripts/index.js"></script>
    <script src="../Scripts/global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script src="https://kit.fontawesome.com/64a3783f0c.js" crossorigin="anonymous"></script>

</head>
<body>
<?php
// Start or resume the session
session_start();

// Redirect if the user is already logged in
if (!isset($_SESSION['username_id'])){
    header('location: index.php');
    exit(); // Ensure no further code execution
}

include ("../Server/connection.php");

// Display errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include ('header.php');

// Redirect if the user is not logged in
if (!isset($_SESSION['username_id'])){
    header('location: index.php');

} else {
    // Check if the form is submitted via POST method
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Check if the form data is received
        $username = $_POST['username'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phone_number'];
        $birthDate = $_POST['birth_date'];
        $gender = $_POST['gender'];
        $city = $_POST['city'];
        $region = $_POST['region'];
        $street = $_POST['street'];

        // Prepare and execute the UPDATE query to edit user data
        $stmt = $conn->prepare('UPDATE users SET user_name=?, user_email=?, first_name=?, last_name=?, phone_number=?, birth_date=?, gender=?, city=?, region=?, street=? WHERE user_id=?');
        $stmt->bind_param('ssssssssssi', $username, $email, $firstName, $lastName, $phoneNumber, $birthDate, $gender, $city, $region, $street, $_SESSION['username_id']);

        // Check if the update is successful
        if ($stmt->execute()) {
            $success = true;
        } else {
            $success = false;
        }

        $stmt->close();
        $conn->close();
    } else {
        // Fetch user data based on $_SESSION['username_id']
        $user_id = $_SESSION['username_id'];
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $username = $row['user_name'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $email = $row['user_email'];
            $phoneNumber = $row['phone_number'];
            $birthDate = $row['birth_date'];
            $gender = $row['gender'];
            $city = $row['city'];
            $region = $row['region'];
            $street = $row['street'];
        }
    }
}

include ('cartPanel.php');
include ('loginPanel.php');
include ('wishlistPanel.php');
?>
<div class="overlay-dark"></div>
<main>
    <section class="container">
        <?php
        if (isset($success)) {
            if ($success) {
                echo ' <div style="color: green"> Updated successful!</div>';
                echo '<div style="font-size: 26px">You will be redirected to your account page </div>';
                echo '<style> form{display: none}</style>';
                echo '<script>
                setTimeout(function() {
                    window.location.href = "account.php";
                }, 2000);
              </script>';
            } else {
                echo ' <div style="color: red"> Update failed. Please try again. </div>';
            }
        }
        ?>
        <header style="background-color: transparent">Registration Form</header>
        <form action="signup.php" method="post" class="form">
            <div class="column">
                <div class="input-box">
                    <label>First Name</label>
                    <input type="text" name="first_name" value="<?php echo isset($firstName) ? $firstName : ''; ?>" placeholder="Enter first name" required disabled />
                </div>
                <div class="input-box">
                    <label>Last name</label>
                    <input type="text" name="last_name" value="<?php echo isset($lastName) ? $lastName : ''; ?>" placeholder="Enter last name" required disabled />
                </div>
            </div>

            <div class="input-box">
                <label>Email Address</label>
                <input type="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" placeholder="Enter email address" required disabled />
            </div>
            <div class="column">
                <div class="input-box">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo isset($username) ? $username : ''; ?>" placeholder="Enter username" required disabled />
                </div>
            </div>

            <div class="column">
                <div class="input-box">
                    <label>Phone Number</label>
                    <input type="number" name="phone_number" value="<?php echo isset($phoneNumber) ? $phoneNumber : ''; ?>" placeholder="Enter phone number" required disabled />
                </div>
                <div class="input-box">
                    <label>Birth Date</label>
                    <input type="date" name="birth_date" value="<?php echo isset($birthDate) ? $birthDate : ''; ?>" placeholder="Enter birth date" required disabled />
                </div>
            </div>
            <div class="gender-box">
                <h3>Gender</h3>
                <div class="gender-option">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" value="male" <?php echo ($gender == 'male') ? 'checked' : ''; ?>  disabled/>
                        <label for="check-male">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" value="female" <?php echo ($gender == 'female') ? 'checked' : ''; ?> disabled/>
                        <label for="check-female">Female</label>
                    </div>
                </div>
            </div>
            <div class="input-box address">
                <label>Address</label>
                <div class="column">
                    <input type="text" name="city" value="<?php echo isset($city) ? $city : ''; ?>" placeholder="Enter city" disabled/>
                    <input type="text" name="region" value="<?php echo isset($region) ? $region : ''; ?>" placeholder="Enter region" disabled/>
                    <input type="text" name="street" value="<?php echo isset($street) ? $street : ''; ?>" placeholder="Enter street" disabled/>
                </div>
            </div>
            <button type="button" id="editBtn" onclick="enableEdit()">Edit</button>
            <button type="button" id="editBtn" onclick="changePassword()">Edit</button>
            <button type="submit" id="saveBtn" name="Save" style="display: none;">Save</button>
            <a href="account.php" class="cancel-btn">Cancel</a>
        </form>
        <script>
            function enableEdit() {
                document.querySelectorAll('input').forEach(input => input.removeAttribute('disabled'));
                document.getElementById('editBtn').style.display = 'none';
                document.getElementById('saveBtn').style.display = 'block';
            }
            function changePassword(){

            }
        </script>
    </section>
</main>
<?php include('footer.html'); ?>
</body>
</html>
l>