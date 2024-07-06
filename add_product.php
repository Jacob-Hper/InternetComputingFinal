<?php
require 'db.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$supplier_id = $_POST['supplier_id'];
$product_id = $_POST['product_id'];
$name = $_POST['product_name'];
$quantity = $_POST['quantity'];
$status = $_POST['status'];
$price = $_POST['price'];
$description = $_POST["description"];

$valid_data = $pdo->prepare("SELECT SupplierID FROM Supplier WHERE SupplierID = :id;");
$valid_data->execute(['id' => $supplier_id]);
$valid_check = $valid_data->fetch();
if ($valid_check){
    $stmt = $pdo->prepare("INSERT INTO Product VALUES (:id, :name, :desc, :price, :quantity, :status, :supplier);");
    $stmt->execute(['quantity' => $quantity, 'status' =>$status, 'id' => $product_id, 'supplier' => $supplier_id, 'price' => $price, 'desc' => $description, 'name' => $name]);
    header('Location: index.php');
}else{
    echo "<script>alert(\"Invalid Supplier ID\"); window.location.replace(\"http://localhost/index.php\");</script>";
}



?>