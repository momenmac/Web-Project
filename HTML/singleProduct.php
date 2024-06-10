

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/index.css" type="text/css">
    <link rel="stylesheet" href="../CSS/singleProduct.css" type="text/css">

    <title>Computers World</title>
    <link href="../IMG/Logo-icon.png" rel="icon">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="../Scripts/product.js"></script>
    <script src="../Scripts/global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script src="https://kit.fontawesome.com/64a3783f0c.js" crossorigin="anonymous"></script>


</head>
<body>

<?php

if(isset($_GET['product_id'])){
    include ('../Server/connection.php');
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $_GET['product_id']);
    $stmt->execute() ;
    $product = $stmt->get_result();

}
else{
    echo "test";
    header('location: index.php');
}

?>

<header id="header">
    <div id="pc-header">
        <div id="top-header">
            <div id="top-header-left">
                <a href="index.php"><img id="logo-image" src="../IMG/Logo.png" alt="Computers World Logo"></a>
            </div>
            <div id="top-header-middle">
                <form id="search-form">
                    <input id="search-input-box" type="text" placeholder="Search the store">
                </form>
                <lord-icon
                    src="https://cdn.lordicon.com/kkvxgpti.json"
                    trigger="hover"
                    colors="primary:#161880"
                    style="width:40px;height:40px">
                </lord-icon>
            </div>

            <div class="top-header-right">
                <a href="#" class="top-header-right-icons">
                    <lord-icon
                        src="https://cdn.lordicon.com/xyboiuok.json"
                        trigger="hover"
                        target=".top-header-right-icons"
                        colors="primary:#FFBC03"
                        style="width:35px;height:35px">
                    </lord-icon>
                    <div>Wish List</div>
                </a>

                <a href="javascript:showLoginPanel()" class="top-header-right-icons">
                    <lord-icon
                        src="https://cdn.lordicon.com/kthelypq.json"
                        trigger="hover"
                        target=".top-header-right-icons"
                        colors="primary:#FFBC03"
                        style="width:35px;height:35px">
                    </lord-icon>

                    <div>Sign in</div>
                </a>


                <a href="javascript:showCartPanel()" class="top-header-right-icons">
                    <div class="cart-button">
                        <lord-icon
                            src="https://cdn.lordicon.com/mfmkufkr.json"
                            trigger="hover"
                            target=".top-header-right-icons"
                            colors="primary:#FFBC03"
                            style="width:35px;height:35px;">
                        </lord-icon>
                        <span class="cart-badge">0</span>
                    </div>
                    <div>Cart</div>
                </a>
            </div>
        </div>
    </div>



    <div id="mobile-header">

    </div>
</header>
<div id="down-header">


    <div class="logo-fixed">
        <a href="index.php"><img id="logo-image2" src="../IMG/Logo.png" alt="Computers World Logo"></a>    </div>
    <div class="navPages-container"></div>

    <div class="down-header-container">
        <nav class="navPages">

            <ul class="navPages-list" data-level-list="1">
                <li class="navPages-list-icons"><a href="index.php">Home
                        <span class="test">New</span></a> </li>
                <li class="navPages-list-icons">
                    <a href="#">
                        Console&nbsp;
                        <lord-icon
                            src="https://cdn.lordicon.com/rmkahxvq.json"
                            trigger="hover"
                            target=".navPages-list-icons"
                            state="hover-arrow-down-2"
                            colors="primary:#ffffff"
                            style="width:20px;height:20px">
                        </lord-icon></a>
                    <div class="navPages-hidden">
                        <div class="transparent">.</div>
                        <div class="navPages-hidden-container">
                            <div class="navPages-hidden-container-inside">
                                <div class="navPages-hidden-container-inside-top">
                                    <div class="col1">
                                        <div><a href="#"><b>Xbox</b></a></div>
                                        <a href="#"><div>Xbox One S</div></a>
                                        <a href="#"><div>Xbox One X</div></a>
                                        <a href="#"><div>Xbox One</div></a>
                                        <a href="#"><div>Xbox 360</div></a>
                                        <a href="#"><div>Xbox Accessories</div></a>
                                    </div>

                                    <div class="col1">
                                        <div><a href="#"><b>Nintendo</b></a></div>
                                        <a href="#"><div>Nintendo Switch</div></a>
                                        <a href="#"><div>Nintendo Switch OLED</div></a>
                                        <a href="#"><div>Nintendo Switch Lite</div></a>
                                        <a href="#"><div>Nintendo Accessories</div></a>
                                    </div>

                                    <div class="col1">
                                        <div><a href="#"><b>Playstation</b></a></div>
                                        <a href="#"><div>Playstation 5 Pro</div></a>
                                        <a href="#"><div>Playstation 5 Lite</div></a>
                                        <a href="#"><div>Playstation Portable</div></a>
                                        <a href="#"><div>Playstation 4 series</div></a>
                                        <a href="#"><div>Playstation Accessories</div></a>
                                    </div>


                                    <div class="col1">
                                        <div><a href="#"><b>Others</b></a></div>
                                        <a href="#"><div>Old Consoles</div></a>
                                        <a href="#"><div>Other Accessories</div></a>
                                        <a href="#"><div>Portable Consoles</div></a>
                                        <a href="#"><div>Consoles Parts</div></a>
                                    </div>



                                </div>
                                <div class="navPages-hidden-container-inside-bottom">
                                    <img src="../IMG/console1.jpg">
                                    <img src="../IMG/console3.jpg">
                                    <img src="../IMG/console2.jpg">
                                    <img src="../IMG/console4.jpg">

                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="navPages-list-icons">
                    <a href="#">
                        Computers&nbsp;
                        <lord-icon
                            src="https://cdn.lordicon.com/rmkahxvq.json"
                            trigger="hover"
                            target=".navPages-list-icons"
                            state="hover-arrow-down-2"
                            colors="primary:#ffffff"
                            style="width:20px;height:20px">
                        </lord-icon>
                    </a>
                    <div class="navPages-hidden">
                        <div class="transparent">.</div>
                        <div class="navPages-hidden-container">
                            <div class="navPages-hidden-container-inside">
                                <div class="navPages-hidden-container-inside-top">
                                    <div class="col1">
                                        <div><a href="#"><b>Hardware</b></a></div>
                                        <a href="#"><div>Computers CPU</div></a>
                                        <a href="#"><div>Motherboards</div></a>
                                        <a href="#"><div>Graphics Cards</div></a>
                                        <a href="#"><div>Memories</div></a>
                                        <a href="#"><div>Hard Drives</div></a>
                                        <a href="#"><div>Power Supplies</div></a>

                                    </div>

                                    <div class="col1">
                                        <div><a href="#"><b>Case Parts</b></a></div>
                                        <a href="#"><div>Cases</div></a>
                                        <a href="#"><div>CPU Coolers</div></a>
                                        <a href="#"><div>GPU Coolers</div></a>
                                        <a href="#"><div>RGB Lights</div></a>
                                        <a href="#"><div>Case FANS</div></a>

                                    </div>

                                    <div class="col1">
                                        <div><a href="#"><b>PCs & Monitors</b></a></div>
                                        <a href="#"><div>Desktops</div></a>
                                        <a href="#"><div>Workstations</div></a>
                                        <a href="#"><div>Laptops</div></a>
                                        <a href="#"><div>Tablets</div></a>
                                        <a href="#"><div>Monitors</div></a>
                                    </div>


                                    <div class="col1">
                                        <div><a href="#"><b>Accessories</b></a></div>
                                        <a href="#"><div>Mouses</div></a>
                                        <a href="#"><div>Keyboards</div></a>
                                        <a href="#"><div>Headsets</div></a>
                                        <a href="#"><div>Microphones</div></a>
                                        <a href="#"><div>Speakers</div></a>
                                    </div>



                                </div>
                                <div class="navPages-hidden-container-inside-bottom">
                                    <img src="../IMG/Computers1.jpg">
                                    <img src="../IMG/Computers2.jpg">
                                    <img src="../IMG/Computers3.jpg">
                                    <img src="../IMG/computers4.jpg">

                                </div>
                            </div>
                        </div>
                    </div>
                </li>


                <li class="navPages-list-icons">
                    <a href="#">
                        Cards&nbsp;
                        <lord-icon
                            src="https://cdn.lordicon.com/rmkahxvq.json"
                            trigger="hover"
                            target=".navPages-list-icons"
                            state="hover-arrow-down-2"
                            colors="primary:#ffffff"
                            style="width:20px;height:20px">
                        </lord-icon></a>
                    <div class="navPages-hidden">
                        <div class="transparent">.</div>
                        <div class="navPages-hidden-container">
                            <div class="navPages-hidden-container-inside">
                                <div class="navPages-hidden-container-inside-bottom" style="height: 80%; margin-top: 60px">
                                    <img src="../IMG/cards1.jpg">
                                    <img src="../IMG/cards2.jpg">
                                    <img src="../IMG/cards3.jpg">
                                    <img src="../IMG/cards4.jpg">
                                    <img src="../IMG/cards5.jpg">
                                    <img src="../IMG/cards6.jpg">
                                    <img src="../IMG/cards7.jpg">
                                    <img src="../IMG/cards8.jpg">

                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="navPages-list-icons">
                    <a href="#">
                        Accessories&nbsp;
                        <lord-icon
                            src="https://cdn.lordicon.com/rmkahxvq.json"
                            trigger="hover"
                            target=".navPages-list-icons"
                            state="hover-arrow-down-2"
                            colors="primary:#ffffff"
                            style="width:20px;height:20px">
                        </lord-icon>
                        <span class="test" id="accessories-badge">Sale</span></a>
                    <div class="navPages-hidden">
                        <div class="transparent">.</div>
                        <div class="navPages-hidden-container">
                            <div class="navPages-hidden-container-inside">
                                <div class="navPages-hidden-container-inside-top">
                                    <div class="col1">
                                        <div><a href="#"><b>Office</b></a></div>
                                        <a href="#"><div>Desks</div></a>
                                        <a href="#"><div>Chairs</div></a>
                                        <a href="#"><div>Printers</div></a>
                                        <a href="#"><div>Routers</div></a>
                                        <a href="#"><div>Bags</div></a>
                                    </div>

                                    <div class="col1">
                                        <div><a href="#"><b>Phones</b></a></div>
                                        <a href="#"><div>Chargers</div></a>
                                        <a href="#"><div>Cases</div></a>
                                        <a href="#"><div>Headphones</div></a>
                                        <a href="#"><div>Car phone Accessories</div></a>
                                    </div>

                                    <div class="col1">
                                        <div><a href="#"><b>PC Accessories</b></a></div>
                                        <a href="#"><div>UPS</div></a>
                                        <a href="#"><div>External Cables</div></a>
                                        <a href="#"><div>External Hard Drives</div></a>
                                        <a href="#"><div>Drawing Boards</div></a>
                                        <a href="#"><div>Adapters & Hubs</div></a>
                                    </div>


                                    <div class="col1">
                                        <div><a href="#"><b>Others</b></a></div>
                                        <a href="#"><div>TVs</div></a>
                                        <a href="#"><div>Mounts & Arms</div></a>
                                        <a href="#"><div>Cameras</div></a>
                                        <a href="#"><div>Software</div></a>
                                    </div>



                                </div>
                                <div class="navPages-hidden-container-inside-bottom">
                                    <img src="../IMG/Accessories1.jpg">
                                    <img src="../IMG/Accessories2.jpg">
                                    <img src="../IMG/Accessories3.jpg">
                                    <img src="../IMG/Accessories4.jpg">

                                </div>
                            </div>
                        </div>
                    </div>

                </li>
                <li class="navPages-list-icons">
                    <a href="#">
                        About&nbsp;
                        <lord-icon
                            src="https://cdn.lordicon.com/rmkahxvq.json"
                            trigger="hover"
                            target=".navPages-list-icons"
                            state="hover-arrow-down-2"
                            colors="primary:#ffffff"
                            style="width:20px;height:20px">
                        </lord-icon></a>
                    <div class="navPages-hidden" style="width: 170px; left:auto;">
                        <div class="transparent">.</div>
                        <div class="navPages-hidden-container" style="height:auto; gap: 0; display: block">
                            <div class="navPages-hidden-container-inside">
                                <div class="navPages-hidden-container-inside-top" style="width: 100%; padding-left: 32px; padding-right: 0; margin-top: 0">
                                    <div class="col1" style="width: 100%">
                                        <a href="#"><div>About Us</div></a>
                                        <a href="#"><div>Contact Us</div></a>
                                        <a href="#"><div>Our team</div></a>
                                        <a href="#"><div>Location</div></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </li>

            </ul>
        </nav>
        <div class="header-bottom-fixed"></div>
    </div>

    <div class="header-bottom-right">
        <div class="top-header-right" id="top-header-right">
            <a href="#" class="top-header-right-icons">
                <lord-icon
                    src="https://cdn.lordicon.com/xyboiuok.json"
                    trigger="hover"
                    target=".top-header-right-icons"
                    colors="primary:#FFBC03"
                    style="width:35px;height:35px">
                </lord-icon>
            </a>

            <a href="javascript:showLoginPanel()" class="top-header-right-icons">
                <lord-icon
                    src="https://cdn.lordicon.com/kthelypq.json"
                    trigger="hover"
                    target=".top-header-right-icons"
                    colors="primary:#FFBC03"
                    style="width:35px;height:35px">
                </lord-icon>
            </a>


            <a href="javascript:showCartPanel()" class="top-header-right-icons">
                <div class="cart-button">
                    <lord-icon
                        src="https://cdn.lordicon.com/mfmkufkr.json"
                        trigger="hover"
                        target=".top-header-right-icons"
                        colors="primary:#FFBC03"
                        style="width:35px;height:35px;">
                    </lord-icon>
                    <span class="cart-badge">0</span>
                </div>
            </a>
        </div>

    </div>

</div>
<div class="cart-right-panel">
    <b>CART</b>
</div>

<div class="login-panel">
    <b>Sign in</b><br>
    <div class="login-panel-container">
        <form method="post" action="index.php">
            <label>
                Username<br>
                <input type="text" maxlength="50" name="username" placeholder="Enter your username"><br>
            </label>
            <label>
                Password<br>
                <input type="password" name="password" maxlength="50">
            </label>
            <input type="submit" name="signInButton" value="Sign in"><br>
            <button type="button" onclick="document.querySelector('.login-panel-container').style.display = 'none'" style="background-color: var(--secondary); color: white">Sign Up</button>

        </form>
        <br>

    </div>

</div>

<div class="overlay-dark"></div>

<main>
    <main class="container-s">
        <?php while ($row = $product->fetch_assoc()){?>
        <!-- Left Column / Headphones Image -->
        <div class="left-column">
            <img data-image="red" class="active" src="../Server/ProductsImages/<?php echo $row['product_image']?>" alt="">
        </div>


        <!-- Right Column -->
        <div class="right-column">

            <!-- Product Description -->
            <div class="product-description">
                <a href="category.php?category=<?php echo $row['product_category'];?>"><span><?php echo $row['product_category'];?></span></a>
                <h1><?php echo $row['product_name'];?></h1>
                <p><?php echo $row['product_description'];?></p>
            </div>

            <!-- Product Configuration -->
            <div class="product-configuration">

                <div class="product-quantity">
                    <div class="container">
                        <div style="font-size: 20px;">Quantity</div><br>
                        <div class="quantity-control" data-quantity="">
                            <button class="quantity-btn" data-quantity-minus="">
                                <svg viewBox="0 0 409.6 409.6">
                                    <g>
                                        <g>
                                            <path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467
                                c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" />
                                        </g>
                                    </g>
                                </svg>
                            </button>
                            <input type="number" class="quantity-input" data-quantity-target="" value="1" step="1" min="1" max="<?php echo $row['quantity_in_stock'];?>" name="quantity">
                            <button class="quantity-btn" data-quantity-plus="">
                                <svg viewBox="0 0 426.66667 426.66667">
                                    <path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437
                        0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031
                        21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344
                        9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344
                        0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div><?php echo $row['quantity_in_stock']?> left in the stock</div>

                </div>

                <!-- Cable Configuration -->
                <div class="price-config">

                </div>
            </div>

            <!-- Product Pricing -->
            <div class="product-price">
                <span>
                    <?php if ($row['product_special_offer']>0){?>
                        <small>₪<?php echo $row['product_price']?><br></small>
                    <?php }?>
                    ₪<?php echo $row['product_price']- $row['product_special_offer']?></span>
            </div>
                <div>
                    <a href="#" class="cart-btn">Add to cart</a>
                    <a href="#" class="wishlist-btn"><i class="fa fa-heart"></i></a>

                </div>



            </div>
        <?php $cat = $row['product_category']; }?>
        <div class="feature-products-container">

            <div class="title">
                <h2>Suggested <b>Products</b></h2>
            </div>
            <?php
            $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ?");
            $stmt->bind_param("s", $cat);
            $stmt->execute();
            $featured_products = $stmt->get_result();
            ?>


            <div class="feature-products-cards-container">
                <?php while ($row = $featured_products->fetch_assoc()){?>
                    <div class="product-card">
                        <?php if ($row['product_special_offer']>0){?>
                            <div class="badge">Sale</div>
                        <?php }?>
                        <div class="product-tumb">
                            <img src="../Server/ProductsImages/<?php echo $row['product_image']?>" alt="">
                        </div>
                        <div class="product-details">
                            <span class="product-catagory"><?php echo $row['product_category']?></span>
                            <h4><a href="singleProduct.php?.product_id=<?php echo $row['product_id']?>"><?php echo $row ['product_name']?></a></h4>
                            <div class="product-bottom-details">
                                <div class="product-price">
                                    <?php if ($row['product_special_offer']>0){?>
                                        <small>₪<?php echo $row['product_price']?><br></small>
                                    <?php }?>
                                    <?php echo $row['product_price']- $row['product_special_offer']?>
                                </div>
                                <div class="product-links">
                                    <a href=""><i class="fa fa-heart"></i></a>
                                    <a href=""><i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>

            </div>
        </div>

    </main>
</main>
<footer>
    <div class="footer-container">
        <div class="footer-container-top">
            <div>
                <img src="../IMG/Logo.png" width="200">
                <div>
                    <b>Address</b><br>
                    16a Vazha-Pshavela Avenue, Tbilisi 0160 <br>
                    42 Ilia Vekua Street, Tbilisi 0167 <br>
                    2 Marjanishvili Street, Tbilisi 0102 <br>
                </div>
            </div>
            <div class="navbar-footer">
                <a href="#">Home</a><br>
                <a href="#">Console</a><br>
                <a href="#">Computers</a><br>
                <a href="#">Cards</a><br>
                <a href="#">Accessories</a><br>
                <a href="#">About</a><br>
            </div>
            <div class="navbar-footer">
                <a href="#">Help</a><br>
                <a href="#">Contact Us</a><br>
                <div>
                    <a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="https://whatsapp.com" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://tiktok.com" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="https://web.telegram.org" target="_blank"><i class="fa-brands fa-telegram"></i></a>
                </div><br>

            </div>

        </div>
        <br>

    </div>

</footer>
</body>
</html>