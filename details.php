<?php
require_once __DIR__ . "/includes/db.php";
require_once __DIR__ . "/includes/header.php";


$id = $_GET["id"];
$field = $_GET["field"];

$stmt = $pdo->prepare("SELECT * FROM textiles WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

echo "<h3>" . ucwords(str_replace("_", " ", $field)) . "</h3>";
echo "<p>" . $data[$field] . "</p>";
?>
