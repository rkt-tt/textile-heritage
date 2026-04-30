<?php
require_once "../includes/db.php";

if ($_POST) {
    $stmt = $pdo->prepare("
        INSERT INTO product_pages (page_key, section, content, image, caption)
        VALUES (?,?,?,?,?)
    ");

    $stmt->execute([$_POST["page_key"], $_POST["section"], $_POST["content"], $_POST["image"], $_POST["caption"]]);

    echo "Saved!";
}
?>

<form method="POST">
Page Key: <input name="page_key"><br>

Section:
<select name="section">
<option>History and Evolution</option>
<option>Heritage</option>
<option>Product Features</option>
<option>Physical Properties</option>
</select><br>

Content:<br>
<textarea name="content"></textarea><br>

Image filename: <input name="image"><br>
Caption:
<input name="caption"><br><br>
<button>Save</button>
</form>