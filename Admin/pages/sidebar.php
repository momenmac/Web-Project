<?php   if (!isset($_SESSION)) {
    header("location: ../index.php");
}?>
<div class="sidebar">
    <h2><a href="../HTML/index.php"><img id="logo-image" src="../IMG/Logo.png" style="width: 90%" alt="Computers World Logo"></a>
    </h2>
    <ul>
        <li><a href="index.php?page=dashboard">Dashboard</a></li>
        <li><a href="index.php?page=products">Products</a></li>
        <li><a href="index.php?page=orders">Orders</a></li>
        <li><a href="index.php?page=users">Users</a></li>
    </ul>
</div>
