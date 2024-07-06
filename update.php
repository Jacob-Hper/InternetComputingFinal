<?php
require 'db.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$product_id;
$supplier;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $supplier_id = $_POST['supplier_id'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    $stmt = $pdo->prepare("UPDATE Product SET Quantity = :quantity, Status = :status WHERE ProductID = :product AND SupplierID = :supplier;");
    $stmt->execute(['quantity' => $quantity, 'status' =>$status, 'product' => $product_id, 'supplier' => $supplier_id]);
    header('Location: index.php');

}else{
    $product_id = $_GET['id'];
    $supplier = $_GET['supplier'];
    $stmt = $pdo->prepare("SELECT SupplierID FROM Supplier WHERE SupplierName = :supplier;");
    $stmt->execute(['supplier' => $supplier]);
    $supplier_id = $stmt->fetch();
    $supplier_id = $supplier_id['SupplierID'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .container label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        .container input[type="text"],
        .container input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update</h2>
        <?php echo "<p>Product: " . $product_id . " Supplier: " . $supplier . "(" . $supplier_id . ")<p>"?>
        <form method="post" action="update.php">
            <?php echo "<input type=\"text\" id=\"product_id\" name=\"product_id\" value = \"" . $product_id . "\" hidden>" ?>
            <?php echo "<input type=\"text\" id=\"supplier_id\" name=\"supplier_id\" value = \"" . $supplier_id . "\" hidden>" ?>
            <label for="quantity">New Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" required>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>