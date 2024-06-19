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
if (isset($_GET['search'])) {
    $search =  $_GET['search'];
}
elseif (isset($_GET['cat'])){
    $cat = $_GET['cat'];
}
else
    header('location: index.php');

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
    <div class="feature-products-container">


        <?php
        if (isset($_GET['search'])) {
            $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ? OR product_category LIKE ? OR product_description LIKE ?");
            $search_s = "%" . $search . "%";
            $stmt->bind_param('sss', $search_s, $search_s, $search_s);
            $stmt->execute();
            $featured_products = $stmt->get_result();
        }
        else{
            $stmt = $conn->prepare("SELECT * FROM products WHERE  product_category LIKE ?");
            $cat_s = "%" . $cat . "%";
            $stmt->bind_param('s', $cat_s);
            $stmt->execute();
            $featured_products = $stmt->get_result();
        }

        ?>
        <div class="title">
            <h2><?php echo isset($_GET['search']) ?"Search for  ": ""; ?> <b><?php echo isset($_GET['search']) ?$search: $cat; ?></b></h2>
        </div>


        <div class="feature-products-cards-container">

            <?php while ($row = $featured_products->fetch_assoc()){?>
            <form method="post" action="products.php?<?php echo isset($_GET['search']) ?'search='.$search: 'cat='.$cat; ?>">
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
                            <img src="../Admin/ProductsImages/<?php echo $row['product_image']?>" alt="">
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
<?php include ('footer.html')?>
</body>
</html>