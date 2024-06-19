<?php
include('connection.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function redirect($page) {
    header("Location: ../index.php?page=$page");
    exit;
}

if (isset($_POST['addProduct'])) {
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productSpecialOffer = isset($_POST['productSpecialOffer']) ? $_POST['productSpecialOffer'] : NULL;
    $productColor = $_POST['productColor'];
    $productStock = $_POST['productStock'];

    $query = "INSERT INTO products (product_name, product_category, product_description, product_price, product_special_offer, product_color, quantity_in_stock";

    // Handle image upload
    if (!empty($_FILES['productImage']['name'])) {
        $image = $_FILES['productImage']['name'];
        $target = "../ProductsImages/" . basename($image);

        // Ensure the directory exists
        if (!is_dir("../ProductsImages/")) {
            mkdir("../ProductsImages/", 0777, true);
        }

        if (!move_uploaded_file($_FILES['productImage']['tmp_name'], $target)) {
            echo "Error uploading image: " . $_FILES['productImage']['error'];
            exit;
        } else {
            $query .= ", product_image) VALUES ('$productName', '$productCategory', '$productDescription', '$productPrice', '$productSpecialOffer', '$productColor', '$productStock', '$image')";
        }
    } else {
        $query .= ") VALUES ('$productName', '$productCategory', '$productDescription', '$productPrice', '$productSpecialOffer', '$productColor', '$productStock')";
    }

    if ($conn->query($query) === TRUE) {
        redirect('products');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Edit Product
if (isset($_POST['editProduct'])) {
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productSpecialOffer = isset($_POST['productSpecialOffer']) ? $_POST['productSpecialOffer'] : NULL;
    $productColor = $_POST['productColor'];
    $productStock = $_POST['productStock'];

    $query = "UPDATE products SET 
        product_name='$productName', 
        product_category='$productCategory', 
        product_description='$productDescription', 
        product_price='$productPrice', 
        product_special_offer='$productSpecialOffer', 
        product_color='$productColor', 
        quantity_in_stock='$productStock'";

    // Handle image upload
    if (!empty($_FILES['productImage']['name'])) {
        $image = $_FILES['productImage']['name'];
        $target = "../ProductsImages/" . basename($image);
        $query .= ", product_image='$image'";

        // Ensure the directory exists
        if (!is_dir("../ProductsImages/")) {
            mkdir("../ProductsImages/", 0777, true);
        }

        if (!move_uploaded_file($_FILES['productImage']['tmp_name'], $target)) {
            echo "Error uploading image: " . $_FILES['productImage']['error'];
            exit;
        }
    }

    $query .= " WHERE product_id='$productId'";

    if ($conn->query($query) === TRUE) {
        redirect('products');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Delete Product
if (isset($_GET['delete_product'])) {
    $id = $_GET['delete_product'];

    $query = "DELETE FROM products WHERE product_id='$id'";
    if ($conn->query($query) === TRUE) {
        redirect('products');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Delete Order
if (isset($_GET['delete_order'])) {
    $id = $_GET['delete_order'];

    $query = "DELETE FROM orders WHERE id='$id'";
    if ($conn->query($query) === TRUE) {
        redirect('orders');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Delete User
if (isset($_GET['delete_user'])) {
    $id = $_GET['delete_user'];

    $query = "DELETE FROM users WHERE user_id='$id'";
    if ($conn->query($query) === TRUE) {
        redirect('users');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Add User
if (isset($_POST['addUser'])) {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userPassword = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (user_name, user_email, user_password) VALUES ('$userName', '$userEmail', '$userPassword')";

    if ($conn->query($query) === TRUE) {
        redirect('users');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Edit User
if (isset($_POST['editUser'])) {
    $userId = $_POST['userId'];
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userPassword = !empty($_POST['userPassword']) ? password_hash($_POST['userPassword'], PASSWORD_DEFAULT) : null;

    $query = "UPDATE users SET 
        user_name='$userName', 
        user_email='$userEmail'";

    if ($userPassword) {
        $query .= ", user_password='$userPassword'";
    }

    $query .= " WHERE user_id='$userId'";

    if ($conn->query($query) === TRUE) {
        redirect('users');
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Close the connection once at the end
$conn->close();
?>