<?php
require 'db.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 50px;
        }
        .table-container {
            margin-top: 30px;
        }
        .form-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Welcome to the Inventory System</h1>
                <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
            </div>
        </div>
        
        <div class="row table-container">
            <div class="col-md-12">
                <h2>Product List</h2>
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Supplier Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query('SELECT p.*, s.SupplierName FROM Product p JOIN Supplier s ON p.SupplierID = s.SupplierID');
                        while ($row = $stmt->fetch()) {
                            echo '<tr>';
                            echo '<td>' . htmlspecialchars($row['ProductID']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['ProductName']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Description']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Price']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Quantity']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['Status']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['SupplierName']) . '</td>';
                            echo '<td><a href="update.php?id=' . $row['ProductID'] . '">Update</a> | <a href="delete.php?id=' . $row['ProductID'] . '">Delete</a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row form-container">
            <div class="col-md-12">
                <h2>Add New Product</h2>
                <form method="post" action="add_product.php" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                        <div class="invalid-feedback">Please enter a product name.</div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                        <div class="invalid-feedback">Please enter a description.</div>
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                        <div class="invalid-feedback">Please enter a price.</div>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                        <div class="invalid-feedback">Please enter a quantity.</div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                        <div class="invalid-feedback">Please enter a status.</div>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier ID:</label>
                        <input type="number" class="form-control" id="supplier_id" name="supplier_id" required>
                        <div class="invalid-feedback">Please enter a supplier ID.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>