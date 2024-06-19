<?php
include ('server/connection.php');
?>

<div class="container mt-5">
    <h1>Users</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM users";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['user_id']}</td>
                    <td>{$row['user_name']}</td>
                    <td>{$row['user_email']}</td>
                    <td>
                        <a href='server/functions.php?delete_user={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
