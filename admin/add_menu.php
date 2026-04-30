<?php
session_start();

require_once __DIR__ . "/../includes/db.php";

if($_POST){

    $stmt = $pdo->prepare("
        INSERT INTO coe_menu (title, page_key, sort_order)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([
        $_POST['title'],
        $_POST['page_key'],
        $_POST['sort_order']
    ]);

    echo "Menu Added!";
}
?>

<form method="POST">
Title: <input name="title" required><br><br>
Page Key: <input name="page_key" required><br><br>
Sort Order: <input name="sort_order" type="number"><br><br>
<button>Add Menu</button>
</form>
