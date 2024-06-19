<?php
include ('server/connection.php');
if (!isset($_SESSION)) {
    header("location: ../index.php");
}
?>

<div class="container mt-5">
    <h1>Products</h1>
    <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Image</th>
            <th>Price</th>
            <th>Special Offer</th>
            <th>Color</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM products";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['product_category']}</td>
                    <td>{$row['product_description']}</td>
                    <td><img src='ProductsImages/{$row['product_image']}' width='50'></td>
                    <td>{$row['product_price']}</td>
                    <td>{$row['product_special_offer']}</td>
                    <td>{$row['product_color']}</td>
                    <td>{$row['quantity_in_stock']}</td>
                    <td>
                        <a href='#' class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#editProductModal' data-id='{$row['product_id']}' data-name='{$row['product_name']}' data-category='{$row['product_category']}' data-description='{$row['product_description']}' data-image='{$row['product_image']}' data-price='{$row['product_price']}' data-offer='{$row['product_special_offer']}' data-color='{$row['product_color']}' data-stock='{$row['quantity_in_stock']}'>Edit</a>
                        <a href='server/functions.php?delete_product={$row['product_id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="server/functions.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Product Category</label>
                        <input type="text" class="form-control" id="productCategory" name="productCategory" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" onchange="previewImage(event)" required>
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; width: 100px; height: auto; margin-top: 10px;">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="productPrice" name="productPrice" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="productSpecialOffer" class="form-label">Special Offer</label>
                        <input type="number" class="form-control" id="productSpecialOffer" name="productSpecialOffer">
                    </div>
                    <div class="mb-3">
                        <label for="productColor" class="form-label">Product Color</label>
                        <input type="text" class="form-control" id="productColor" name="productColor">
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Product Stock</label>
                        <input type="number" class="form-control" id="productStock" name="productStock" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="addProduct">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="server/functions.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editProductId" name="productId">
                    <div class="mb-3">
                        <label for="editProductName" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="productName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductCategory" class="form-label">Product Category</label>
                        <input type="text" class="form-control" id="editProductCategory" name="productCategory" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductDescription" class="form-label">Product Description</label>
                        <textarea class="form-control" id="editProductDescription" name="productDescription" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editProductImage" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="editProductImage" name="productImage" accept="image/*" onchange="previewEditImage(event)">
                        <img id="editImagePreview" src="#" alt="Image Preview" style="display: none; width: 100px; height: auto; margin-top: 10px;">
                    </div>
                    <div class="mb-3">
                        <label for="editProductPrice" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="editProductPrice" name="productPrice" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductSpecialOffer" class="form-label">Special Offer</label>
                        <input type="number" class="form-control" id="editProductSpecialOffer" name="productSpecialOffer">
                    </div>
                    <div class="mb-3">
                        <label for="editProductColor" class="form-label">Product Color</label>
                        <input type="text" class="form-control" id="editProductColor" name="productColor">
                    </div>
                    <div class="mb-3">
                        <label for="editProductStock" class="form-label">Product Stock</label>
                        <input type="number" class="form-control" id="editProductStock" name="productStock" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="editProduct">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function previewEditImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('editImagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const editProductModal = document.getElementById('editProductModal');
        editProductModal.addEventListener('show.bs.modal', (event) => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const category = button.getAttribute('data-category');
            const description = button.getAttribute('data-description');
            const image = button.getAttribute('data-image');
            const price = button.getAttribute('data-price');
            const offer = button.getAttribute('data-offer');
            const color = button.getAttribute('data-color');
            const stock = button.getAttribute('data-stock');

            const modalBody = editProductModal.querySelector('.modal-body');
            modalBody.querySelector('#editProductId').value = id;
            modalBody.querySelector('#editProductName').value = name;
            modalBody.querySelector('#editProductCategory').value = category;
            modalBody.querySelector('#editProductDescription').value = description;
            modalBody.querySelector('#editProductPrice').value = price;
            modalBody.querySelector('#editProductSpecialOffer').value = offer;
            modalBody.querySelector('#editProductColor').value = color;
            modalBody.querySelector('#editProductStock').value = stock;

            const editImagePreview = modalBody.querySelector('#editImagePreview');
            editImagePreview.src = 'uploads/' + image;
            editImagePreview.style.display = 'block';
        });
    });
</script>
