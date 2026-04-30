<?php
session_start();

require_once __DIR__ . "/../includes/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

if ($_POST) {
    $stmt = $pdo->prepare("
        INSERT INTO products (product_key, product_name) 
        VALUES (?, ?)
    ");

    $stmt->execute([$_POST["product_key"], $_POST["product_name"]]);

    header("Location: product.php");
}
?>

<h2>Add Product</h2>

<form method="POST">
    Product Key:<br>
    <input name="product_key" required><br><br>

    Product Name:<br>
    <input name="product_name" required><br><br>

    <button>Add</button>
</form>
