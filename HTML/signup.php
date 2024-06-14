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
include ('header.php');
include ('cartPanel.php');
include ('loginPanel.php');
include ('wishlistPanel.php');
?>
<main>
<section class="container">
    <header style="background-color: transparent">Registration Form</header>
    <form action="#" class="form">
        <div class="input-box">
            <label>Full Name</label>
            <input type="text" placeholder="Enter full name" required />
        </div>

        <div class="input-box">
            <label>Email Address</label>
            <input type="text" placeholder="Enter email address" required />
        </div>

        <div class="column">
            <div class="input-box">
                <label>Phone Number</label>
                <input type="number" placeholder="Enter phone number" required />
            </div>
            <div class="input-box">
                <label>Birth Date</label>
                <input type="date" placeholder="Enter birth date" required />
            </div>
        </div>
        <div class="gender-box">
            <h3>Gender</h3>
            <div class="gender-option">
                <div class="gender">
                    <input type="radio" id="check-male" name="gender" checked />
                    <label for="check-male">male</label>
                </div>
                <div class="gender">
                    <input type="radio" id="check-female" name="gender" />
                    <label for="check-female">Female</label>
                </div>
                <div class="gender">
                    <input type="radio" id="check-other" name="gender" />
                    <label for="check-other">prefer not to say</label>
                </div>
            </div>
        </div>
        <div class="input-box address">
            <label>Address</label>
            <input type="text" placeholder="Enter street address" required />
            <input type="text" placeholder="Enter street address line 2" required />
            <div class="column">
                <div class="select-box">
                    <select>
                        <option hidden>Country</option>
                        <option>America</option>
                        <option>Japan</option>
                        <option>India</option>
                        <option>Nepal</option>
                    </select>
                </div>
                <input type="text" placeholder="Enter your city" required />
            </div>
            <div class="column">
                <input type="text" placeholder="Enter your region" required />
                <input type="number" placeholder="Enter postal code" required />
            </div>
        </div>
        <button>Submit</button>
    </form>
</section>
</main>
<?php include('footer.html'); ?>
</body>
</html>