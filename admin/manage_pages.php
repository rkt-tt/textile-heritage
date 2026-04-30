<?php

require_once __DIR__ . "/../includes/db.php";

$stmt = $pdo->query("SELECT * FROM coe_pages ORDER BY page_key ASC");
?>

<h2>Manage Pages</h2>

<a href="edit_page.php">➕ Add New Page</a>

<table border="1" cellpadding="10">
<tr>
<th>Page Key</th>
<th>Title</th>
<th>Action</th>
</tr>

<?php while ($row = $stmt->fetch()): ?>
<tr>
<td><?= $row["page_key"] ?></td>
<td><?= $row["title"] ?></td>
<td>
<a href="edit_page.php?key=<?= $row["page_key"] ?>">Edit</a>
</td>
</tr>
<?php endwhile; ?>

</table>
