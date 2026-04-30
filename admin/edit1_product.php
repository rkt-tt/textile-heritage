<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"] ?? "";

/* =====================
   FETCH EXISTING DATA
===================== */
$stmt = $pdo->prepare("SELECT * FROM product_pages WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    echo "Record not found";
    exit();
}

/* =====================
   UPDATE DATA
===================== */
if ($_POST) {
    $stmt = $pdo->prepare("
        UPDATE product_pages 
        SET section=?, content=?, image=?, caption=? 
        WHERE id=?
    ");

    $stmt->execute([$_POST["section"], $_POST["content"], $_POST["image"], $_POST["caption"], $id]);

    header("Location: manage_product_sections.php?product=" . $data["page_key"]);
    exit();
}
?>

<h2>Edit Product Section</h2>

<form method="POST">

<b>Product:</b> <?= $data["page_key"] ?><br><br>

Section:
<select name="section">
<option <?= $data["section"] == "History and Evolution" ? "selected" : "" ?>>History and Evolution</option>
<option <?= $data["section"] == "Heritage" ? "selected" : "" ?>>Heritage</option>
<option <?= $data["section"] == "Product Features" ? "selected" : "" ?>>Product Features</option>
<option <?= $data["section"] == "Physical Properties" ? "selected" : "" ?>>Physical Properties</option>
</select><br><br>

Content:<br>
<textarea name="content" rows="8" cols="60"><?= htmlspecialchars($data["content"]) ?></textarea><br><br>

Image filename:
<input name="image" value="<?= $data["image"] ?>"><br><br>

<?php if ($data["image"]): ?>
    <img src="../assets/images/<?= $data["image"] ?>" width="200"><br><br>
    Caption:
<input name="caption" value="<?= $data["caption"] ?>"><br><br>
<?php endif; ?>

<button>Update</button>

</form>