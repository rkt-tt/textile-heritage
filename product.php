<?php

require_once __DIR__ . "/includes/db.php";

$id = $_GET["id"] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM textiles WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

echo "<h2>" . $data["product_name"] . "</h2>";
echo "<p>" . $data["description"] . "</p>";
?>
