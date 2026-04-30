<?php
session_start();

require_once __DIR__ . "/../includes/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM products WHERE status=1 ORDER BY product_name ASC");
?>

<h2>Manage Products</h2>

<a href="add_product_master.php">➕ Add New Product</a>

<table border="1" cellpadding="10">
<tr>
    <th>Product Name</th>
    <th>Action</th>
</tr>

<?php while ($row = $stmt->fetch()): ?>
<tr>
    <td><?= htmlspecialchars($row["product_name"]) ?></td>
    <td>
        <a href="manage_product_sections.php?product=<?= $row["product_key"] ?>">
            Manage Sections
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>
