<?php session_start()?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/cart.css" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/64a3783f0c.js" crossorigin="anonymous"></script>

    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="../Scripts/global.js"></script>
    <script src="../Scripts/index.js"></script>

    <link rel="stylesheet" href="../CSS/index.css" type="text/css">
    <link rel="stylesheet" href="../CSS/cart.css" type="text/css">
    <link href="../IMG/Logo-icon.png" rel="icon">

    <title>Document</title>
</head>
<body>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const quantityControl = document.querySelector('.quantity-control');
        const input = quantityControl.querySelector('.quantity-input');
        const minusBtn = quantityControl.querySelector('[data-quantity-minus]');
        const plusBtn = quantityControl.querySelector('[data-quantity-plus]');

        minusBtn.addEventListener('click', function() {
            const currentValue = parseInt(input.value, 10);
            const minValue = parseInt(input.min, 10);
            if (currentValue > minValue) {
                input.value = currentValue - 1;
            }
        });

        plusBtn.addEventListener('click', function() {
            const currentValue = parseInt(input.value, 10);
            const maxValue = parseInt(input.max, 10);
            if (currentValue < maxValue) {
                input.value = currentValue + 1;
            }
        });

        input.addEventListener('change', function() {
            const currentValue = parseInt(input.value, 10);
            const minValue = parseInt(input.min, 10);
            const maxValue = parseInt(input.max, 10);

            if (currentValue < minValue) {
                input.value = minValue;
            } else if (currentValue > maxValue) {
                input.value = maxValue;
            }
        });
    });
    function contShopping() {
            window.location.href = 'index.php';
    };

</script>

<?php
include ("../Server/connection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['clearWishlist'])) {
        unset($_SESSION['wishlist']);
        if (isset($_SESSION['logged_in'])) {// Get the user ID from the session
            $stmt = $conn->prepare("DELETE FROM wishlist_items WHERE user_id = ?");
            $stmt->bind_param("ii", $_SESSION['username_id']); // "ii" means two integers
            $stmt->execute();
            $stmt->close();
        }
    }
    elseif (isset($_POST['trash'])){
        unset($_SESSION['wishlist'][$_POST['product_id']]);
        if (isset($_SESSION['logged_in'])) {// Get the user ID from the session
            $stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param("ii", $_SESSION['username_id'], $_POST['product_id']); // "ii" means two integers
            $stmt->execute();
            $stmt->close();
        }


    }

}


include ('header.php');
include("cartPanel.php");
include("loginPanel.php");
include ("wishlistPanel.php");
?>


<style>
    #down-header{
        height: 77px;
    }
</style>
<div class="overlay-dark"></div>
<section class="pt-5 pb-5 ">
    <div class="container">
        <div class="row w-100">
            <div class="col-lg-12 col-md-12 col-12">
                <h3 class="display-5 mb-2 text-center">Wishlist</h3>
                <p class="mb-5 text-center">
                    <i class="text-info font-weight-bold" style="color: var(--secondary)"><?php echo isset($_SESSION['wishlist']) ? count($_SESSION['wishlist']) : 0; ?></i> items in your wishlist</p>
                <table id="shoppingCart" class="table table-condensed table-responsive">
                    <thead>
                    <tr>
                        <th style="width:60%">Product</th>
                        <th style="width:12%"></th>
                        <th style="width:10%"></th>
                        <th style="width:16%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    if (isset($_SESSION['wishlist']) && !empty($_SESSION['wishlist'])) {
                    foreach ($_SESSION['wishlist'] as $item) {
                    $total = $total + ($item['product_price'] * $item['product_quantity']);
                    ?>
                    <tr>
                        <form action="wishlist.php" method="post">
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-md-3 text-left">
                                    <img src="../Server/ProductsImages/<?php echo $item['product_image']?>" style="padding: 10px" alt="" class="img-fluid d-none d-md-block rounded mb-2 shadow ">
                                </div>
                                <div class="col-md-9 text-left mt-sm-2">
                                    <a href="singleProduct.php?product_id=<?php echo $item['product_id']?>"><h4 style="color: black"><?php echo $item['product_name']?></h4></a>
                                    <p class="font-weight-light">
                                        <a href="category.php?category=<?php echo $item['product_category'];?>" ><div><?php echo $item['product_category'];?></div></a>
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>

                        </td>
                        <td>

                        </td>
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']?>">
                        <td class="actions" data-th="">
                            <div class="text-right">
                                <button class="btn btn-white border-secondary bg-white btn-md mb-2" name="trash">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                        </form>
                    </tr>

                    <?php }
                     }
                    else{
                        ?>
                        <tr>
                            <td data-th="Product" colspan="10" style="padding-top: 10px; padding-bottom: 10px">
                                Your Wishlist is empty
                            </td>
                        </tr>
                        <?php
                    }

                    ?>
                    </tbody>
                </table>

            </div>
        </div>
        <div style="position: sticky; bottom: 0; background-color: var(--background-color)">

            <form method="post" action="wishlist.php">
            <div class="row mt-4 d-flex align-items-center">
                <div class="col-sm-6 order-md-2 text-right" >
                    <button type="submit" name="clearWishlist" class="btn btn-primary mb-4 btn-lg pl-5 pr-5 buttons_in_cart" style="background-color: var(--secondary); border: none; ">Clear Wishlist</button>

                </div>
                <div class="col-sm-6 mb-3 mb-m-1 order-md-1 text-md-left">
                    <a href="javascript:contShopping()">
                        <i class="fas fa-arrow-left mr-2"></i> Continue Shopping</a>
                </div>
            </div>
            </form>

        </div>

    </div>
</section>
<?php include("footer.html");?>
</body>
</html>