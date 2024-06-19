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
if (isset($_POST['logout'])){
    session_destroy();
    header('location: index.php');

}
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

        if (isset($_POST['Save'])) {
            // Update user data
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
        } elseif (isset($_POST['change'])) {
            // Change password
            $oldPassword = $_POST['old_password'];
            $newPassword = $_POST['new_password'];
            $user_id = $_SESSION['username_id'];

            // Fetch current password
            $stmt = $conn->prepare('SELECT user_password FROM users WHERE user_id=?');
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->bind_result($currentPasswordHash);
            $stmt->fetch();
            $stmt->close();

            // Verify the old password
            if (password_verify($oldPassword, $currentPasswordHash)) {
                // Hash the new password
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

                // Update the password in the database
                $stmt = $conn->prepare('UPDATE users SET user_password=? WHERE user_id=?');
                $stmt->bind_param('si', $newPasswordHash, $user_id);

                if ($stmt->execute()) {
                    $passwordChangeSuccess = true;
                } else {
                    $passwordChangeSuccess = false;
                }

                $stmt->close();
            } else {
                $passwordChangeSuccess = false;
                $passwordChangeError = 'Old password is incorrect.';
            }

        }
    }
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
$conn->close();
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
                echo ' <div class="alert-success" style="color: green"> Updated successful!</div>';
                echo '<script>
                setTimeout(function() {
                    document.getElementsByClassName("alert-success")[0].style.display = "none";
                }, 5000);
              </script>';
            } else {
                echo ' <div style="color: red"> Update failed. Please try again. </div>';
            }
        }
        if (isset($passwordChangeSuccess)) {
            if ($passwordChangeSuccess) {
                echo ' <div class="alert-success" style="color: green"> Updated password successful!</div>';
                echo '<script>
                setTimeout(function() {
                    document.getElementsByClassName("alert-success")[0].style.display = "none";
                }, 5000);
              </script>';
            } else {
                echo ' <div style="color: red"> couldn\'t update password </div>';
            }
        }

        ?>
        <header style="background-color: transparent">Registration Form</header>
        <form id="update-info-form" action="account.php" method="post" class="form">
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
            <div class="column">
                <button type="button" id="editBtn" onclick="enableEdit()">Edit</button>
                <button type="submit" id="saveBtn" name="Save" style="display: none;">Save</button>
                <button type="button" id="cancel" onclick="window.location.href = 'account.php';"  style="display: none; background-color: var(--secondary)">Cancel</button>

            </div>
            <style>
                form button{
                    border-radius: 15px;
                    transition: 0.3s ease;

                }
                form button:hover{
                    transform: scale(1.03);
                    transition: 0.3s ease;
                }
            </style>


        </form>

        <form id="change-password-form" style="display: none" action="account.php" method="post" class="form">
            <div class="input-box">
                <label>Old password</label>
                <input type="password" name="old_password"  placeholder="Enter old password" required />
            </div>
            <div class="input-box">
                <label>New password</label>
                <input type="password" name="new_password"  placeholder="Enter new password" required  />
            </div>
            <button type="submit" id="saveBtn" name="change" >change password</button>

        </form>
        <br>
        <a href="account.php" class="cancel-btn">Cancel</a>
        <br>
        <br>
        <a href="javascript:changePassword()" class="cancel-btn">Change password</a>
        <br>
        <br>
        <form method="post" >
            <button style="width: 20%; background-color: var(--cerise); padding: 10px 5px; border:none; color: white; font-size: 22px; cursor: pointer" type="submit" name="logout" class="cancel-btn">Logout</button>
            <?php
            // Check if the user is an admin
            if ($_SESSION['role'] == 1) {
                echo '<a href="../Admin/index.php" style="width: 20%; background-color: var(--secondary); padding: 10px 7px; border:none; color: white; font-size: 22px; cursor: pointer; margin-left: 10px; border-radius: 15px;" class="cancel-btn">Admin Panel</a>';
            }
            ?>
        </form>
        <script>
            function enableEdit() {
                document.querySelectorAll('input').forEach(input => input.removeAttribute('disabled'));
                document.getElementById('editBtn').style.display = 'none';
                document.getElementById('saveBtn').style.display = 'block';
                document.getElementById('cancel').style.display = 'block';

            }
            function changePassword(){
                document.getElementById('change-password-form').style.display = 'block';
                document.getElementById('update-info-form').style.display = 'none';
            }

        </script>
    </section>
</main>
<?php include('footer.html'); ?>
</body>
</html>
