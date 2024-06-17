<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/index.css" type="text/css">
    <link rel="stylesheet" href="../CSS/aboutus.css" type="text/css">

    <title>Computers World</title>
    <link href="../IMG/Logo-icon.png" rel="icon">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="../Scripts/product.js"></script>
    <script src="../Scripts/index.js"></script>
    <script src="../Scripts/global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script src="https://kit.fontawesome.com/64a3783f0c.js" crossorigin="anonymous"></script>


</head>
<body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelectorAll('.navPages-hidden-container a');
        const headerHeight = document.querySelector('header').offsetHeight;

        navLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').split('#')[1];
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });
</script>

<?php

include('header.php');
?>
<script>
    document.getElementById("home-navPage").classList.remove("active-navbar");
</script>

<?Php
    include("cartPanel.php");
    include("loginPanel.php");
    include ("wishlistPanel.php");
?>
<div class="overlay-dark"></div>
<main>
    <section id="about-us">
        <h1 >About Us</h1>
        <p>Welcome to Computers World! We are dedicated to providing the best quality computers and accessories to our customers. Our mission is to offer top-notch products and exceptional customer service.</p>
        <div class="content-wrap">
            <div class="container">
                <h2 class="title"><span>Why shop</span> with us?</h2>
                <div class="block-list">
                    <div class="block-item">
                        <div class="img">
                            <img class="lazyloaded" src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/icon-with-us1.png" alt="Free Shipping On First Order" data-src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/icon-with-us1.png">
                        </div>
                        <div class="content">
                            <h4 class="heading">Free Shipping On First Order</h4>
                            <p class="desc">Enjoy free shipping on your first order with us!</p>
                            <a class="link" href="#">Learn more</a>
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="img">
                            <img class="lazyloaded" src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/icon-with-us2.png" alt="Weekly Flash Sale" data-src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/icon-with-us2.png">
                        </div>
                        <div class="content">
                            <h4 class="heading">Weekly Flash Sale</h4>
                            <p class="desc">Don't miss our weekly flash sales for great deals!</p>
                            <a class="link" href="#">Learn more</a>
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="img">
                            <img class="lazyloaded" src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/icon-with-us3.png" alt="Annual Payment Discount" data-src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/icon-with-us3.png">
                        </div>
                        <div class="content">
                            <h4 class="heading">Annual Payment Discount</h4>
                            <p class="desc">Save more with our annual payment discount.</p>
                            <a class="link" href="#">Learn more</a>
                        </div>
                    </div>
                    <div class="block-item">
                        <div class="img">
                            <img class="lazyloaded" src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/icon-with-us4.png" alt="Cashback Reward Program" data-src="https://cdn11.bigcommerce.com/s-cas40rmoh/product_images/uploaded_images/icon-with-us4.png">
                        </div>
                        <div class="content">
                            <h4 class="heading">Cashback Reward Program</h4>
                            <p class="desc">Earn cashback rewards on your purchases.</p>
                            <a class="link" href="#">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact-us">
        <h1>Contact Us</h1>
        <p class="hidehide">Have questions or need support? Reach out to us.</p>
        <p class="hidehide">We're happy to answer questions or help you with returns.<br>Please fill out the form below if you need assistance.</p>
        <div class="page page-contact">
            <main class="page-content">
                <div class="halo-contact-form">
                    <div id="contact-us-page">
                        <form data-contact-form="" class="form" action="#" method="post">
                            <input type="hidden" name="page_id" id="page_id" value="4">
                            <div class="form-row form-row--half">
                                <div class="form-field">
                                    <label class="form-label" for="contact_fullname">Full Name <span>*</span></label>
                                    <input class="form-input" type="text" id="contact_fullname" name="contact_fullname" required>
                                </div>
                                <div class="form-field">
                                    <label class="form-label" for="contact_phone">Phone Number <span>*</span></label>
                                    <input class="form-input" type="text" id="contact_phone" name="contact_phone" required>
                                </div>
                                <div class="form-field">
                                    <label class="form-label" for="contact_email">Email Address <span>*</span></label>
                                    <input class="form-input" type="email" id="contact_email" name="contact_email" required>
                                    <span style="display: none;"></span>
                                </div>
                                <div class="form-field">
                                    <label class="form-label" for="contact_orderno">Order Number</label>
                                    <input class="form-input" type="text" id="contact_orderno" name="contact_orderno">
                                </div>
                                <div class="form-field">
                                    <label class="form-label" for="contact_companyname">Company Name</label>
                                    <input class="form-input" type="text" id="contact_companyname" name="contact_companyname">
                                </div>
                                <div class="form-field">
                                    <label class="form-label" for="contact_rma">RMA Number</label>
                                    <input class="form-input" type="text" id="contact_rma" name="contact_rma">
                                </div>
                            </div>
                            <div class="form-field">
                                <label class="form-label" for="contact_question">Comments/Questions <span>*</span></label>
                                <textarea name="contact_question" id="contact_question" rows="10" cols="50" class="form-input" required></textarea>
                                <span style="display: none;"></span>
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LcjX0sbAAAAACp92-MNpx66FT4pbIWh-FTDmkkz"></div>
                            <br>
                            <div class="form-actions">
                                <input class="button button--primary button--large" type="submit" value="Submit Contact">
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </section>
<!--    Contact us scripts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.form').submit(function(event) {
                event.preventDefault();
                $('p.hidehide').hide();
                var $form = $(this);
                // FormNoTime
                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    success: function(response) {
                        // Hide the form
                        $form.hide();
                        // Display thank you message
                        var $thankYouMessage = $('<p>Thank you for submitting! We will get back to you as soon as possible.</p>');
                        $form.after($thankYouMessage);
                    },
                    error: function() {
                        // Handle errors if needed
                        alert('Error submitting form.');
                    }
                });
            });
        });
    </script>


    <section id="our-team">
        <h1>Our Team</h1>
        <p>Meet the dedicated team behind Computers World:</p>

        <!-- Flex container for team members and team picture -->
        <div class="team-container">
            <!-- Team members -->
            <div class="team-members">
                <div class="team-member">
                    <img src="../IMG/bluePerson.png" alt="Team Member 1">
                    <div class="team-info">
                        <h2>Lucifer</h2>
                        <p>CEO</p>
                    </div>
                </div>

                <div class="team-member">
                    <img src="../IMG/bluePerson.png" alt="Team Member 2">
                    <div class="team-info">
                        <h2>Nopo</h2>
                        <p>Little helper</p>
                    </div>
                </div>
            </div>


            <!-- Team picture -->
            <div class="team-picture">
                <img src="../IMG/teambro.png" alt="Team Picture">
            </div>
        </div>
    </section>

    <section id="location">
        <h1>Location</h1>
        <p>Visit our store at the west of Georgia at the heart of Tbilisi</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d954.2252087966508!2d44.76841622916979!3d41.69421321014104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x406e91016bdecb59%3A0x6a5c8691923a32b3!2s16a%20Vazha-Pshavela%20Ave%2C%20Tbilisi%200160%2C%20Georgia!5e0!3m2!1sen!2sus!4v1623833031001!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>
</main>
<?php include ('footer.html')?>
</body>
</html>