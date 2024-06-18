<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../CSS/index.css" type="text/css">
  <title>Computers World</title>
  <link href="../IMG/Logo-icon.png" rel="icon">
  <script src="https://cdn.lordicon.com/lordicon.js"></script>
  <script src="../Scripts/index.js"></script>
    <script src="../Scripts/global.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
  <script src="https://kit.fontawesome.com/64a3783f0c.js" crossorigin="anonymous"></script>


</head>
<body>
<?php
include ("../Server/connection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addToCart'])) {
        $product = [
            'product_image' => $_POST['product_image'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_id' => $_POST['product_id'],
            'product_special_offer' => $_POST['product_special_offer'],
            'product_category' => $_POST['product_category'],
            'quantity_in_stock' => $_POST['quantity_in_stock'],
            'product_quantity'=> 1
        ];

        if (!isset($_SESSION['cart'][$_POST['product_id']])) {
            $_SESSION['cart'][$_POST['product_id']] = $product;
        }
        else{
            $_SESSION['cart'][$_POST['product_id']]['product_quantity'] += 1;
        }
        if (isset($_SESSION['logged_in'])) {
            $qt=1;
            $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)");
            echo "test";
            $stmt->bind_param("iii", $_SESSION['username_id'], $_POST['product_id'],$qt);
            $stmt->execute();
            $stmt->close();
        }

    }
    if (isset($_POST['addToWishlist'])) {
        $product = [
            'product_image' => $_POST['product_image'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_id' => $_POST['product_id'],
            'product_special_offer' => $_POST['product_special_offer'],
            'product_category' => $_POST['product_category'],
        ];

        if (!isset($_SESSION['wishlist'][$_POST['product_id']])) {
            $_SESSION['wishlist'][$_POST['product_id']] = $product;
        }
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if (isset($_SESSION['logged_in'])) {
            $stmt = $conn->prepare("INSERT INTO wishlist_items (user_id, product_id) VALUES (?, ?)");
            $userId = $_SESSION['username_id'];
            $productId = $_POST['product_id'];
            $stmt->bind_param("ii", $userId, $productId);

            if (!$stmt->execute()) {
                die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            }
            $stmt->close();
        }

    }
}
include("header.php");
include ("cartPanel.php");
include ("loginPanel.php");
include ("wishlistPanel.php");



?>






<div class="overlay-dark"></div>

<main>

  <section id="slide-show">
  <div class="slideshow-container">
    <a href="#">
    <div class="mySlides fade" style="background-image: url('../IMG/slideshow-home1-2.jpg');">
      <div class="dots-container">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
      </div>
    </div>
    </a>

    <a href="#">
    <div class="mySlides fade" style="background-image: url('../IMG/slideshow-home1-1.jpg');">
      <div class="slides-captions">
        Huge Savings on UHD Televisions
        <div class="slides-captions2">
          Sale up to 70% off on selected items*<br>
        </div>
        <span>Shop Now</span>

      </div>
      <div class="dots-container">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
      </div>
    </div>
    </a>

    <a href="#">
    <div class="mySlides fade" style="background-image: url('../IMG/slideshow-home1-3.jpg');">
      <div class="dots-container">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
      </div>
    </div>
    </a>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
</section>
<section class="main">
  <div class="shipping-custom-block-container">
  <div class="shipping-custom-block">

    <div class="custom-block-item">
      <div id="animationContainer" style="width: 65px; height: 65px;"><script src="../IMG/animatedDeliveryIcons.js"></script></div>
      <div>Fast Delivery</div>
    </div>
    <div class="line">|</div>
    <div class="custom-block-item">
      <div id="animationContainer1" style="width: 65px; height: 65px;"><script src="../IMG/animatedCashIcons.js"></script></div>
      <div>Cash on Delivery</div>
    </div>
    <div class="line2">|</div>
    <div class="custom-block-item">
      <div id="animationContainer2" style="width: 55px; height: 55px;"><script src="../IMG/animatedThumbIcons.js"></script></div>
      <div>Longest Warranties</div>
    </div>
  </div>
  </div>

  <div id="gallery-home">
    <div id="gallery-home-small-container">
      <a href="index.php" class="gallery-home-small">
        <img src="../IMG/gallery-small1.jpg">
      </a>
      <a href="index.php" class="gallery-home-small">
        <img src="../IMG/gallery-small2.jpg">
      </a>
      <a href="index.php" class="gallery-home-small">
        <img src="../IMG/gallery-small3.jpg">
      </a>
    </div>
    <div id="gallery-home-big-container">
      <a href="index.php" id="gallery-home-big">
        <img src="../IMG/gallery-big.png">
      </a>
    </div>

  </div>
</section>
<div class="home-content">
<section class="shop-by-category">
  <div class="shop-by-category-title">Shop by category</div>
  <div class="shop-by-category-container">
    <div class="shop-by-category-grid">
      <a href="products.php?cat=Laptops" class="category-card">
        <div class="category-image">
          <img src="../IMG/Laptops.png" alt="img">
        </div>
        <div class="category-name">Laptops</div>
      </a>
      <a href="products.php?cat=Monitors" class="category-card">
        <div class="category-image">
          <img src="../IMG/Monitors.png" alt="img">
        </div>
        <div class="category-name">Monitors</div>
      </a>
      <a href="products.php?cat=Cases" class="category-card">
        <div class="category-image">
          <img src="../IMG/Cases.png" alt="img">
        </div>
        <div class="category-name">Cases</div>
      </a>
      <a href="products.php?cat=Computer CPU" class="category-card">
        <div class="category-image">
          <img src="../IMG/CPUs.png" alt="img">
        </div>
        <div class="category-name">Computer CPU</div>
      </a>
      <a href="products.php?cat=Motherboards" class="category-card">
        <div class="category-image">
          <img src="../IMG/Motherboards.png" alt="img">
        </div>
        <div class="category-name">Motherboards</div>
      </a>
      <a href="products.php?cat=Computer Drives" class="category-card">
        <div class="category-image">
          <img src="../IMG/ComputerDrives.png" alt="img">
        </div>
        <div class="category-name">Computer Drives</div>
      </a>
      <a href="products.php?cat=GPU Cards" class="category-card">
        <div class="category-image">
          <img src="../IMG/GPUs.png" alt="img">
        </div>
        <div class="category-name">GPU Cards</div>
      </a>
      <a href="products.php?cat=Ram Memory" class="category-card">
        <div class="category-image">
          <img src="../IMG/RAMMEMORY.png" alt="img">
        </div>
        <div class="category-name">Ram Memory</div>
      </a>
      <a href="products.php?cat=Gaming Chairs" class="category-card">
        <div class="category-image">
          <img src="../IMG/Chairs.png" alt="img">
        </div>
        <div class="category-name">Gaming Chairs</div>
      </a>
      <a href="products.php?cat=Headsets" class="category-card">
        <div class="category-image">
          <img src="../IMG/Headset.png"  alt="img">
        </div>
        <div class="category-name">Headsets</div>
      </a>


    </div>
  </div>
  <div class="shop-by-category-show-more">
    <a href="#">
    <span class="show-more">
      <div>Show More</div>
      <lord-icon
              src="https://cdn.lordicon.com/vduvxizq.json"
              trigger="hover"
              target=".show-more"
              state="hover-ternd-flat-3"
              style="width:40px;height:40px">
      </lord-icon>
    </span>
    </a>
  </div>
</section>

</div>
    <div class="feature-products-container">

            <div class="title">
                <h2>Featured <b>Products</b></h2>
            </div>
        <?php
        include ("../Server/get_featured_products.php")?>


        <div class="feature-products-cards-container">

            <?php while ($row = $featured_products->fetch_assoc()){?>
            <form method="post" action="index.php">
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                <input type="hidden" name="product_name" value="<?php echo $row[ 'product_name']; ?>"/>
                <input type="hidden" name="product_price" value="<?php echo $row[ 'product_price']; ?>"/>
                <input type="hidden" name="product_id" value="<?php echo $row[ 'product_id']; ?>"/>
                <input type="hidden" name="product_special_offer" value="<?php echo $row[ 'product_special_offer']; ?>"/>
                <input type="hidden" name="product_category" value="<?php echo $row[ 'product_category']; ?>"/>
                <input type="hidden" name="quantity_in_stock" value="<?php echo $row[ 'quantity_in_stock']; ?>"/>



                <div class="product-card">
                        <?php if ($row['product_special_offer']>0){?>
                        <div class="badge">Sale</div>
                        <?php }?>
                        <div class="product-tumb">
                            <img src="../Server/ProductsImages/<?php echo $row['product_image']?>" alt="">
                        </div>
                        <div class="product-details">
                            <span class="product-catagory"><?php echo $row['product_category']?></span>
                            <h4><a href="singleProduct.php?product_id=<?php echo $row['product_id']?>"><?php echo $row ['product_name']?></a></h4>
                            <div class="product-bottom-details">
                                <div class="product-price">
                                    <?php if ($row['product_special_offer']>0){?>
                                    <small>₪<?php echo $row['product_price']?><br></small>
                                    <?php }?>
                                    ₪<?php echo $row['product_price']- $row['product_special_offer']?>
                                </div>
                                <div class="product-links">
                                    <button type="submit" name="addToWishlist"><a href=""><i class="fa fa-heart"></i></a></button>
                                    <button type="submit" name="addToCart"><a><i class="fa fa-shopping-cart"></i></a></button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
            <?php }?>


    </div>
    </div>
    <div class="get-offers-div-container">
        <div class="get-offers-div">
            <div>
                <lord-icon
                        src="https://cdn.lordicon.com/nzixoeyk.json"
                        trigger="loop"
                        colors="primary:#ffffff"
                        style="width:40px;height:40px">
                </lord-icon>
            </div>
            <div>
                Sign up to Newsletter
            </div>
            <div>
                ...and be the first to receive Special Offers
            </div>
            <div>
      <span>
        <form action="">
          <input type="email" placeholder="Enter your email address">
          <input type="submit" value="Subscribe" id="">
        </form>
      </span>
            </div>
        </div>
    </div>

</main>
<?php include ('footer.html')?>
</body>
</html>