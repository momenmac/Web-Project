<?php session_start()?>
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
include('header.php');
?>
<script>
    document.getElementById("home-navPage").classList.remove("active-navbar");
</script>

<?Php
    include("cartPanel.php");
    include("loginPanel.php")
?>
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
        <?php $cat = $row['product_category'];
                $pid = $row['product_id'];
        }?>
        <div class="feature-products-container">

            <div class="title">
                <h2>Suggested <b>Products</b></h2>
            </div>
            <?php
            $stmt = $conn->prepare("SELECT * FROM products WHERE product_category = ? and not(product_id = ?)");
            $stmt->bind_param("si", $cat, $pid);

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
                            <h4><a href="singleProduct.php?product_id=<?php echo $row['product_id']?>"><?php echo $row ['product_name']?></a></h4>
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
<?php include ('footer.html')?>
</body>
</html>