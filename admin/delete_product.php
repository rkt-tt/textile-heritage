<?php
session_start();

require_once __DIR__ . "/../includes/db.php";

// सुरक्षा: केवल logged-in admin ही delete कर सके
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

// Validate ID
$id = $_GET["id"] ?? "";

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM product_pages WHERE id=?");
    $stmt->execute([$id]);
}

// Redirect back
header("Location: product.php");
exit();
