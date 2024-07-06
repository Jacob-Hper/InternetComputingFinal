<?php
require 'db.php';

$username = 'User';
$password = 'password';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute(['username' => $username, 'password' => $hashed_password]);
    echo "New user created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}