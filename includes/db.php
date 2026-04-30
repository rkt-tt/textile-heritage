<?php
$host = "localhost";
$db = "textile_heritage";
$user = "heritage_user";
$pass = "Heritage@textile1";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed");
}
?>
