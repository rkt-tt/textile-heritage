<?php
session_start();

require_once __DIR__ . "/../includes/db.php";

if (!isset($_SESSION["admin"])) {
    die("Unauthorized");
}

$id = $_GET["id"];

$stmt = $pdo->prepare("DELETE FROM textiles WHERE id=?");
$stmt->execute([$id]);

header("Location: dashboard.php");
