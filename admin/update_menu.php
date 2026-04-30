<?php

require_once __DIR__ . "/../includes/db.php";

$id = $_POST["id"];
$field = $_POST["field"];
$value = $_POST["value"];

$allowed = ["title", "sort_order"];

if (!in_array($field, $allowed)) {
    die("Invalid");
}

$stmt = $pdo->prepare("UPDATE coe_menu SET $field=? WHERE id=?");
$stmt->execute([$value, $id]);
