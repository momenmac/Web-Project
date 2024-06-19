<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    // Enable error reporting
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('../server/connection.php');
    if (!isset($_SESSION['role'])) {
        header('Location: ../index.php');
    }

    if (isset($_GET['order_id'])) {
        $order_id = intval($_GET['order_id']);

        // Fetch order details
        $orderQuery = "
        SELECT orders.order_id, orders.order_cost, orders.order_date, users.user_name
        FROM orders
        JOIN users ON orders.user_id = users.user_id
        WHERE orders.order_id = ?
        ";

        // Fetch order items for the specified order_id
        $itemsQuery = "
        SELECT order_items.product_id, products.product_name, products.product_image, order_items.quantity, products.product_price
        FROM order_items
        JOIN products ON order_items.product_id = products.product_id
        WHERE order_items.order_id = ?
        ";

        if ($orderStmt = $conn->prepare($orderQuery)) {
            $orderStmt->bind_param('i', $order_id);
            $orderStmt->execute();
            $orderResult = $orderStmt->get_result();
            if ($orderResult->num_rows > 0) {
                $order = $orderResult->fetch_assoc();
            } else {
                echo "No order found.";
                exit;
            }
            $orderStmt->close();
        } else {
            echo "Error preparing order details statement: " . $conn->error;
            exit;
        }

        if ($itemsStmt = $conn->prepare($itemsQuery)) {
            $itemsStmt->bind_param('i', $order_id);
            $itemsStmt->execute();
            $itemsResult = $itemsStmt->get_result();
            if ($itemsResult->num_rows === 0) {
                echo "No items found for this order.";
                exit;
            }
            $itemsStmt->close();
        } else {
            echo "Error preparing order items statement: " . $conn->error;
            exit;
        }
    } else {
        echo "No order ID specified.";
        exit;
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Order Details</h1>
    <div class="mb-3">
        <h4>User Name: <?php echo htmlspecialchars($order['user_name']); ?></h4>
        <h4>Order Date: <?php echo htmlspecialchars($order['order_date']); ?></h4>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Image</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $totalOrderCost = 0;
        while ($item = $itemsResult->fetch_assoc()) :
            $totalPrice = $item['quantity'] * $item['product_price'];
            $totalOrderCost += $totalPrice;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($item['product_id']); ?></td>
                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                <td><img src="../ProductsImages/<?php echo htmlspecialchars($item['product_image']); ?>" alt="<?php echo htmlspecialchars($item['product_name']); ?>" style="width: 100px; height: auto;"></td>
                <td>$<?php echo htmlspecialchars($item['product_price']); ?></td>
                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                <td>$<?php echo htmlspecialchars($totalPrice); ?></td>
            </tr>
        <?php endwhile; ?>
        <tr>
            <td colspan="5" align="right"><strong>Total Order Cost:</strong></td>
            <td>$<?php echo htmlspecialchars($totalOrderCost); ?></td>
        </tr>
        </tbody>
    </table>
    <a href="javascript:history.go(-1)" class="btn btn-primary">Back to Orders</a>
</div>
</body>
</html>
