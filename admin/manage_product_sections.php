<?php

require_once __DIR__ . "/../includes/db.php";


$product = $_GET["product"] ?? "";

$stmt = $pdo->prepare("SELECT * FROM product_pages WHERE page_key=?");
$stmt->execute([$product]);
?>

<h2>Sections: <?= $product ?></h2>

<a href="add_product.php">➕ Add Section</a>

<table border="1">
<tr>
<th>Section</th>
<th>Image</th>
<th>Action</th>
</tr>

<?php while ($row = $stmt->fetch()): ?>
<tr>
<td><?= $row["section"] ?></td>
<td><?= $row["image"] ?></td>
<td>
<a href="edit_product.php?product=<?= $row["page_key"] ?>&section=<?= urlencode($row["section"]) ?>">Edit</a> |
<a href="delete_product.php?id=<?= $row["id"] ?>&product=<?= $product ?>"
   onclick="return confirm('Delete this section?')">
   Delete
</a>
</td>
</tr>
<?php endwhile; ?>
</table>
