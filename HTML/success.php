<?php
session_start();
include ('../Server/connection.php');

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;

if ($order_id) {
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed Successfully - Computers World</title>
    <link href="../IMG/Logo-icon.png" rel="icon">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/success.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="../Scripts/product.js"></script>
    <script src="../Scripts/index.js"></script>
    <script src="../Scripts/global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script src="https://kit.fontawesome.com/64a3783f0c.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include('header.php'); ?>
<main>
    <div class="container mt-5">
        <h1 class="mb-4">Order Placed Successfully!</h1>
        <p class="order-number">Your order number is <strong><?php echo htmlspecialchars($order['order_id']); ?></strong>.</p>
        <p class="confirmation-message">You will receive a confirmation email with the order details.</p>
        <a href="index.php" class="btn btn-primary btn-lg">Continue Shopping</a>
    </div>
</main>
<?php include ('footer.html'); ?>
</body>
</html>
