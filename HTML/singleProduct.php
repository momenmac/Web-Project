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
    <script src="../Scripts/index.js"></script>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>-->
    <script src="https://kit.fontawesome.com/64a3783f0c.js" crossorigin="anonymous"></script>


</head>
<body>

<?php
include ('../Server/connection.php');

if(isset($_GET['product_id'])){
    $pid = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $_GET['product_id']);
    $stmt->execute() ;
    $product = $stmt->get_result();

}
else if (isset($_POST['addToCart'])) {

        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $_POST['product_id_main']);
        $pid = $_POST['product_id_main'];
        $stmt->execute() ;
        $product = $stmt->get_result();
        $product2 = [
            'product_image' => $_POST['product_image'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_id' => $_POST['product_id'],
            'product_special_offer' => $_POST['product_special_offer'],
            'product_category' => $_POST['product_category'],
            'quantity_in_stock' => $_POST['quantity_in_stock'],
            'product_quantity'=> $_POST['product_quantity'],
        ];

    if (!isset($_SESSION['cart'][$_POST['product_id']])) {
            $_SESSION['cart'][$_POST['product_id']] = $product2;
        }
        else{
            if ( $_SESSION['cart'][$_POST['product_id']]['product_quantity'] + $_POST['product_quantity'] <= $_SESSION['cart'][$_POST['product_id']]['quantity_in_stock'] ) {
                $_SESSION['cart'][$_POST['product_id']]['product_quantity'] += $_POST['product_quantity'];
            }else{
                $_SESSION['cart'][$_POST['product_id']]['product_quantity'] =$_SESSION['cart'][$_POST['product_id']]['quantity_in_stock'];

            }

        }
    if (isset($_SESSION['logged_in'])) {
        $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $_SESSION['username_id'], $_POST['product_id'],$_POST['product_quantity']);
        $stmt->execute();
        $stmt->close();
    }

}
else if (isset($_POST['addToWishlist'])) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $_POST['product_id_main']);
    $pid = $_POST['product_id_main'];
    $stmt->execute() ;
    $product = $stmt->get_result();
    $product2 = [
        'product_image' => $_POST['product_image'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_id' => $_POST['product_id'],
        'product_special_offer' => $_POST['product_special_offer'],
        'product_category' => $_POST['product_category'],
    ];

    if (!isset($_SESSION['wishlist'][$_POST['product_id']])) {
        $_SESSION['wishlist'][$_POST['product_id']] = $product2;
    }
    if (isset($_session['logged_in'])) {
        $stmt = $conn->prepare("INSERT INTO wishlist_items  (wishlist_item_id, user_id, product_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $_session['username_id'], $_POST['product_id']);
        $stmt->execute();
        $stmt->close();
    }

}
else{
    header('location: index.php');
}



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
    <main class="container-s">
        <?php while ($row = $product->fetch_assoc()){
            $cat = $row['product_category'];
            $pid = $row['product_id'];
            ?>
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
                <form method="post" action="singleProduct.php">

            <!-- Product Configuration -->
            <div class="product-configuration">
                <div class="product-quantity">
                    <div class="container">
                        <div style="font-size: 20px;">Quantity</div><br>
                        <div class="quantity-control" data-quantity="">
                            <button class="quantity-btn" type="button" data-quantity-minus="">
                                <svg viewBox="0 0 409.6 409.6">
                                    <g>
                                        <g>
                                            <path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467
                                c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" />
                                        </g>
                                    </g>
                                </svg>
                            </button>
                            <input type="number" class="quantity-input" data-quantity-target="" value="1" step="1" min="1" max="<?php echo $row['quantity_in_stock'];?>" name="product_quantity">
                            <button class="quantity-btn" type="button" data-quantity-plus="">
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
                    <input type="hidden" name="product_id_main" value="<?php echo $pid ?>"/>
                    <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                        <input type="hidden" name="product_name" value="<?php echo $row[ 'product_name']; ?>"/>
                        <input type="hidden" name="product_price" value="<?php echo $row[ 'product_price']; ?>"/>
                        <input type="hidden" name="product_id" value="<?php echo $row[ 'product_id']; ?>"/>
                        <input type="hidden" name="product_special_offer" value="<?php echo $row[ 'product_special_offer']; ?>"/>
                        <input type="hidden" name="product_category" value="<?php echo $row[ 'product_category']; ?>"/>
                        <input type="hidden" name="quantity_in_stock" value="<?php echo $row[ 'quantity_in_stock']; ?>"/>
                        <button name="addToCart" class="cart-btn">Add to cart</button>
                        <button name="addToWishlist" type="submit" class="wishlist-btn"><i class="fa fa-heart"></i></button>

                </div>
                </form>
            </div>
        <?php
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
                    <form method="post" action="singleProduct.php">
                        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                        <input type="hidden" name="product_name" value="<?php echo $row[ 'product_name']; ?>"/>
                        <input type="hidden" name="product_price" value="<?php echo $row[ 'product_price']; ?>"/>
                        <input type="hidden" name="product_quantity" value="1"/>
                        <input type="hidden" name="product_id" value="<?php echo $row[ 'product_id']; ?>"/>
                        <input type="hidden" name="product_special_offer" value="<?php echo $row[ 'product_special_offer']; ?>"/>
                        <input type="hidden" name="product_category" value="<?php echo $row[ 'product_category']; ?>"/>
                        <input type="hidden" name="quantity_in_stock" value="<?php echo $row[ 'quantity_in_stock']; ?>"/>
                        <input type="hidden" name="product_id_main" value="<?php echo $pid ?>"/>




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

    </main>
</main>
<?php include ('footer.html')?>
</body>
</html>