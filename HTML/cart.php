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
        if (window.history.length > 1) {
            history.go(-1);
        } else {
            window.location.href = 'index.php';
        }
    };

</script>

<?php
include ("../Server/connection.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['clearCart'])) {
        unset($_SESSION['cart']);
        if (isset($_SESSION['logged_in'])) {// Get the user ID from the session
            $stmt = $conn->prepare("DELETE FROM cart_items WHERE user_id = ?");
            $stmt->bind_param("i", $_SESSION['username_id']); // "ii" means two integers
            $stmt->execute();
            $stmt->close();
        }
    }
    else if (isset($_POST['sync'])) {
        if (isset($_SESSION['cart'][$_POST['product_id']])) {
            if ( $_POST['quantity'] <= $_SESSION['cart'][$_POST['product_id']]['quantity_in_stock'] ) {
                $_SESSION['cart'][$_POST['product_id']]['product_quantity'] = $_POST['quantity'];
            }else{
                $_SESSION['cart'][$_POST['product_id']]['product_quantity'] =$_SESSION['cart'][$_POST['product_id']]['quantity_in_stock'];

            }
        }
        if (isset($_session['logged_in'])) {
            $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE user_id = ? AND product_id = ?");
            $stmt->bind_param("iii",$_SESSION['cart'][$_POST['product_id']]['product_quantity'], $_session['username_id'], $_POST['product_id']);
            $stmt->execute();
            $stmt->close();
        }
    }
    elseif (isset($_POST['trash'])){
        unset($_SESSION['cart'][$_POST['product_id']]);
        if (isset($_SESSION['logged_in'])) {// Get the user ID from the session
            $stmt = $conn->prepare("DELETE FROM cart_items WHERE user_id = ? AND product_id = ?");
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
                <h3 class="display-5 mb-2 text-center">Shopping Cart</h3>
                <p class="mb-5 text-center">
                    <i class="text-info font-weight-bold" style="color: var(--secondary)"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></i> items in your cart</p>
                <table id="shoppingCart" class="table table-condensed table-responsive">
                    <thead>
                    <tr>
                        <th style="width:60%">Product</th>
                        <th style="width:12%">Price</th>
                        <th style="width:10%">Quantity</th>
                        <th style="width:16%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total = 0;
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                    $total = $total + (($item['product_price'] -$item['product_special_offer']) * $item['product_quantity']);
                    ?>
                    <tr>
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
                        <td data-th="Price">
                            <div class="product-price">
                                <?php if ($item['product_special_offer']>0){?>
                                    <small style="width: 100%">₪<?php echo $item['product_price']?><br></small>
                                <?php }?>
                                ₪<?php echo $item['product_price']- $item['product_special_offer']?>
                            </div>
                        </td>
                        <form action="cart.php" method="post">

                        <td data-th="Quantity">
                            <div class="quantity-control" data-quantity="">
                                <button class="quantity-btn" data-quantity-minus="" type="button">
                                    <svg viewBox="0 0 409.6 409.6">
                                        <g>
                                            <g>
                                                <path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467
                                c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" />
                                            </g>
                                        </g>
                                    </svg>
                                </button>
                                <input type="number" class="quantity-input" data-quantity-target="" value="<?php echo $item['product_quantity'];?>" step="1" min="1" max="<?php echo $item['quantity_in_stock'];?>" name="quantity">
                                <button class="quantity-btn" data-quantity-plus="" type="button">
                                    <svg viewBox="0 0 426.66667 426.66667">
                                        <path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437
                        0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031
                        21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344
                        9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344
                        0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0" />
                                    </svg>
                                </button>
                            </div>

                        </td>
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']?>">
                        <td class="actions" data-th="">
                            <div class="text-right">

                                <button class="btn btn-white border-secondary bg-white btn-md mb-2" name="sync">
                                    <i class="fas fa-sync"></i>
                                </button>
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
                                Your Cart is empty
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
            <div class="float-right text-right" >
                <h4>Subtotal:</h4>
                <h1>
                    ₪<?php echo $total?>
                </h1>
            </div>
            <form method="post" action="cart.php">
            <div class="row mt-4 d-flex align-items-center">
                <div class="col-sm-6 order-md-2 text-right" >
                    <a href="catalog.html" class="btn btn-primary mb-4 btn-lg pl-5 pr-5 buttons_in_cart" style="background-color: var(--yellow); border: none">Checkout</a>
                    <button type="submit" name="clearCart" class="btn btn-primary mb-4 btn-lg pl-5 pr-5 buttons_in_cart" style="background-color: var(--secondary); border: none; ">Clear Cart</button>

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

<style>
    .login-panel-container label{
        padding-top: 10px;
    }
</style>
<?php include("footer.html");?>
</body>
</html>