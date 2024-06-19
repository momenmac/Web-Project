<?php
include ('server/connection.php');
?>

<div class="container mt-5">
    <h1>Users</h1>
    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</a>
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
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['user_id']}</td>
                        <td>{$row['user_name']}</td>
                        <td>{$row['user_email']}</td>
                        <td>
                            <a href='#' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#editUserModal' 
                            data-id='{$row['user_id']}' 
                            data-name='{$row['user_name']}' 
                            data-email='{$row['user_email']}'>Edit</a>
                            <a href='server/functions.php?delete_user={$row['user_id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="server/functions.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="userName" name="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addUser">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="server/functions.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editUserId" name="userId">
                    <div class="mb-3">
                        <label for="editUserName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUserName" name="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editUserEmail" name="userEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="editUserPassword" name="userPassword">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="editUser">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editUserModal = document.getElementById('editUserModal');
        editUserModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');

            const modalBody = editUserModal.querySelector('.modal-body');
            modalBody.querySelector('#editUserId').value = id;
            modalBody.querySelector('#editUserName').value = name;
            modalBody.querySelector('#editUserEmail').value = email;
        });
    });
</script>
