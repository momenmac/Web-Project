<?php
session_start();
include ('../Server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['username_id'])) {
        header("Location: signup.php");
        exit();
    }

    // Gather and sanitize form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $phone = $_POST['phone'];
    $paymentMethod = $_POST['paymentMethod'];

    //We are poor students
    if ($paymentMethod == 'paypal') {
        // PayPal payment
    } else {
        // Credit card payment
    }

    // Insert
    $orderCost = 0;
    foreach ($_SESSION['cart'] as $item) {
        $orderCost += ($item['product_price'] - $item['product_special_offer']) * $item['product_quantity'];
    }

    $conn->begin_transaction();

    try {
        // Insert
        $stmt = $conn->prepare("INSERT INTO orders (order_cost, user_id) VALUES (?, ?)");
        $stmt->bind_param("di", $orderCost, $_SESSION['username_id']);
        $stmt->execute();
        $orderId = $stmt->insert_id;
        $stmt->close();

        // Insert
        foreach ($_SESSION['cart'] as $item) {
            $productId = $item['product_id'];
            $quantity = $item['product_quantity'];

            $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $orderId, $productId, $quantity);
            $stmt->execute();
            $stmt->close();
        }

        // Clear
        unset($_SESSION['cart']);
        $stmt = $conn->prepare("DELETE FROM cart_items WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['username_id']);
        $stmt->execute();
        $stmt->close();


        $conn->commit();

        //Redirect
        header("Location: success.php?order_id=" . $orderId);
        exit();
    } catch (Exception $e) {

        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>