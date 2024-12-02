<?php
require 'db/connection.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4" style='color: #2b7a78;'>Product Dashboard</h1>

        <div class="text-end mb-4">
            <button style='background-color: #85A98F; border: none; border-radius: 5px; padding: 14px; color: white; font-weight: 500;' data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
        </div>

        <!-- Table to display products -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td>
    
    <div class="d-flex justify-content-start">
        <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo $row['id']; ?>" data-name="<?php echo $row['name']; ?>" data-price="<?php echo $row['price']; ?>" data-description="<?php echo $row['description']; ?>">Edit</button>

        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
    </div>
</td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- add product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_product.php" method="POST">
                        <div class="mb-3">
                            <label for="newProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" id="newProductName" required>
                        </div>
                        <div class="mb-3">
                            <label for="newProductPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="newProductPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="newProductDescription" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="newProductDescription" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Edit Product -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="edit_product.php" method="POST">
                        <input type="hidden" name="id" id="productId">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" id="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" id="productPrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="productDescription" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var editButtons = document.querySelectorAll('button[data-bs-toggle="modal"]');
        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-id');
                var productName = this.getAttribute('data-name');
                var productPrice = this.getAttribute('data-price');
                var productDescription = this.getAttribute('data-description');

                // Fill the modal fields
                document.getElementById('productId').value = productId;
                document.getElementById('productName').value = productName;
                document.getElementById('productPrice').value = productPrice;
                document.getElementById('productDescription').value = productDescription;
            });
        });
    </script>
</body>
</html>
