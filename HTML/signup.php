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

session_start();
if (isset($_SESSION['username_id'])){
    header('location: index.php');
}
include ("../Server/connection.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include ("../Server/connection.php");

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
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt = $conn->prepare('INSERT INTO users (user_name, user_email, user_password, first_name, last_name, phone_number, birth_date, gender, city, region, street) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param('sssssssssss', $username, $email, $password, $firstName, $lastName, $phoneNumber, $birthDate, $gender, $city, $region, $street);
    if ($stmt->execute()){
       $success = true;
       $_SESSION['username'] = $username;
    }
    else {
        $success = false;
    }
    $stmt->close();
    $conn->close();
}

include ('header.php');
include ('cartPanel.php');
include ('loginPanel.php');
include ('wishlistPanel.php');
?>
<main>
<section class="container">    <?php
    if (isset($success)) {
        if ($success) {
            echo ' <div style="color: green"> Registration successful!</div>';
            echo '<div style="font-size: 26px">You will be redirected to your account page </div>';
            echo '<style> form{display: none}</style>';
            echo '<script>
                setTimeout(function() {
                    window.location.href = "account.php";
                }, 2000);
              </script>';
        } else {
            echo ' <div style="color: red"> Registration failed. Please try again. </div>';
        }

    }?>
    <header style="background-color: transparent">Registration Form</header>
    <form action="signup.php" method="post" class="form">
        <div class="column">
            <div class="input-box">
                <label>First Name</label>
                <input type="text" name="first_name" placeholder="Enter first name" required />
            </div>
            <div class="input-box">
                <label>Last name</label>
                <input type="text" name="last_name" placeholder="Enter last name" required />
            </div>
        </div>

        <div class="input-box">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter email address" required />
        </div>
        <div class="column">
            <div class="input-box">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username" required />
            </div>
            <div class="input-box">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter username" required />
            </div>
        </div>


        <div class="column">
            <div class="input-box">
                <label>Phone Number</label>
                <input type="number" name="phone_number" placeholder="Enter phone number" required />
            </div>
            <div class="input-box">
                <label>Birth Date</label>
                <input type="date" name="birth_date" placeholder="Enter birth date" required />
            </div>
        </div>
        <div class="gender-box">
            <h3>Gender</h3>
            <div class="gender-option">
                <div class="gender">
                    <input type="radio" id="check-male" name="gender" value="male" checked />
                    <label for="check-male">Male</label>
                </div>
                <div class="gender">
                    <input type="radio" id="check-female" name="gender" value="female" />
                    <label for="check-female">Female</label>
                </div>
            </div>
        </div>
        <div class="input-box address">
            <label>Address</label>
            <div class="column">
                <input type="text" name="city" placeholder="Enter city" />
                <input type="text" name="region" placeholder="Enter region"  />
                <input type="text" name="street" placeholder="Enter street"  />
            </div>
        </div>
        <button type="submit">Sign up</button>
    </form>
</section>
</main>
<?php include('footer.html'); ?>
</body>
</html>