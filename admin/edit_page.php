<?php

require_once __DIR__ . "/../includes/db.php";

$key = $_GET['key'] ?? '';
$data = ['title'=>'','content'=>''];

if($key){
    $stmt = $pdo->prepare("SELECT * FROM coe_pages WHERE page_key=?");
    $stmt->execute([$key]);
    $data = $stmt->fetch();
}

if($_POST){
    $stmt = $pdo->prepare("
    INSERT INTO coe_pages (page_key,title,content)
    VALUES (?,?,?)
    ON DUPLICATE KEY UPDATE title=?, content=?
    ");

    $stmt->execute([
        $_POST['page_key'],
        $_POST['title'],
        $_POST['content'],
        $_POST['title'],
        $_POST['content']
    ]);

    echo "Saved!";
}
?>

<form method="POST">
Page Key: <input name="page_key" value="<?= $key ?>"><br>
Title: <input name="title" value="<?= $data['title'] ?>"><br>
Content:<br>
<textarea name="content" rows="10" cols="50"><?= $data['content'] ?></textarea><br>
<button>Save</button>
</form>
