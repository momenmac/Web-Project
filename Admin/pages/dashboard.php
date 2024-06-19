<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include('server/connection.php');
    if (!isset($_SESSION)) {
        header("location: ../index.php");
    }
    // Fetch orders data per day
    $ordersPerDay = [];
    $query = "SELECT DATE(order_date) as order_day, COUNT(*) as order_count FROM orders GROUP BY DATE(order_date)";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ordersPerDay[$row['order_day']] = $row['order_count'];
        }
    }

    // Fetch total money sold per day
    $totalMoneyPerDay = [];
    $moneyQuery = "SELECT DATE(order_date) as money_day, SUM(order_cost) as total_money FROM orders GROUP BY DATE(order_date)";
    $moneyResult = $conn->query($moneyQuery);
    if ($moneyResult && $moneyResult->num_rows > 0) {
        while ($row = $moneyResult->fetch_assoc()) {
            $totalMoneyPerDay[$row['money_day']] = $row['total_money'];
        }
    }


    $queryTotalOrders = "SELECT COUNT(*) as total_orders FROM orders";
    $resultTotalOrders = $conn->query($queryTotalOrders);
    if ($resultTotalOrders && $resultTotalOrders->num_rows > 0) {
        $rowTotalOrders = $resultTotalOrders->fetch_assoc();
        $totalOrders = $rowTotalOrders['total_orders'];
    }

    $queryTotalProducts = "SELECT COUNT(*) as total_products FROM products";
    $resultTotalProducts = $conn->query($queryTotalProducts);
    if ($resultTotalProducts && $resultTotalProducts->num_rows > 0) {
        $rowTotalProducts = $resultTotalProducts->fetch_assoc();
        $totalProducts = $rowTotalProducts['total_products'];
    }

    $queryTotalUsers = "SELECT COUNT(*) as total_users FROM users";
    $resultTotalUsers = $conn->query($queryTotalUsers);
    if ($resultTotalUsers && $resultTotalUsers->num_rows > 0) {
        $rowTotalUsers = $resultTotalUsers->fetch_assoc();
        $totalUsers = $rowTotalUsers['total_users'];
    }
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Total Orders</h5>
                    <p class="card-text"><?php echo $totalOrders; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-box"></i> Total Products</h5>
                    <p class="card-text"><?php echo $totalProducts; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Total Users</h5>
                    <p class="card-text"><?php echo $totalUsers; ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Orders per Day Chart</h5>
                    <canvas id="ordersChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Money Sold per Day Chart</h5>
                    <canvas id="moneyChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Chart.js for graph visualization -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data for charts
    const ordersData = <?php echo json_encode(array_values($ordersPerDay)); ?>;
    const ordersLabels = <?php echo json_encode(array_keys($ordersPerDay)); ?>;
    const moneyData = <?php echo json_encode(array_values($totalMoneyPerDay)); ?>;
    const moneyLabels = <?php echo json_encode(array_keys($totalMoneyPerDay)); ?>;

    // Chart setup for orders per day
    const ordersChart = new Chart(document.getElementById('ordersChart'), {
        type: 'line',
        data: {
            labels: ordersLabels,
            datasets: [{
                label: 'Orders per Day',
                data: ordersData,
                fill: false,
                backgroundColor: 'rgba(255,188,3,0.34)',
                borderColor: 'rgb(255,188,3)',
                tension: 0.1
            }]
        },
        options: {}
    });

    // Chart setup for total money sold per day
    const moneyChart = new Chart(document.getElementById('moneyChart'), {
        type: 'bar',
        data: {
            labels: moneyLabels,
            datasets: [{
                label: 'Total Money Sold per Day',
                data: moneyData,
                backgroundColor: 'rgb(10,108,220,0.1)',
                borderColor: 'rgb(10,108,220,1)',
                borderWidth: 1
            }]
        },
        options: {}
    });
</script>
</body>
</html>
