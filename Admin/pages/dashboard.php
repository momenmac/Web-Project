<?php
include ('server/connection.php');

// Fetch dashboard data
$totalOrders = 0;
$totalProducts = 0;
$totalUsers = 0;

$query = "SELECT COUNT(*) as count FROM orders";
$result = $conn->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    $totalOrders = $row['count'];
}

$query = "SELECT COUNT(*) as count FROM products";
$result = $conn->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    $totalProducts = $row['count'];
}

$query = "SELECT COUNT(*) as count FROM users";
$result = $conn->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    $totalUsers = $row['count'];
}
?>

<div class="container mt-5">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text"><?php echo $totalOrders; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text"><?php echo $totalProducts; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?php echo $totalUsers; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
