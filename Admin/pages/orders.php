<?php
include ('server/connection.php');
if (!isset($_SESSION)) {
    header("location: ../index.php");
}
?>
<div class="container mt-5">
    <h1>Orders</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>User Name</th>
            <th>Total Cost</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "
            SELECT orders.order_id, orders.order_cost, orders.order_status, orders.order_date, users.user_name 
            FROM orders
            JOIN users ON orders.user_id = users.user_id
        ";
        if ($stmt = $conn->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['order_id']}</td>
                        <td>{$row['user_name']}</td>
                        <td>{$row['order_cost']}</td>
                        <td>{$row['order_status']}</td>
                        <td>{$row['order_date']}</td>
                        <td>
                            <a href='pages/orderDetails.php?order_id={$row['order_id']}' class='btn btn-info btn-sm'>View</a>
                            <a href='server/functions.php?delete_order={$row['order_id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
            }
            $stmt->close();
        } else {
            echo "<tr><td colspan='6'>Error retrieving orders.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
