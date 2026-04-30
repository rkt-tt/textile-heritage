<?php
session_start();

require_once __DIR__ . "/../includes/db.php";


if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="dashboard">

    <h1>Admin Panel</h1>
    <p>Welcome, <b><?= htmlspecialchars($_SESSION["admin"]) ?></b></p>

    <hr>

    <!-- ================= CoE ================= -->
    <h2>📌 CoE Management</h2>

    <a href="manage_menu.php">📂 Manage CoE Menu</a>
    <a href="add_menu.php">➕ Add Menu Item</a>
    <a href="manage_pages.php">📄 Manage Pages</a>
    <a href="edit_page.php">➕ Add New Page</a>

    <hr>

    <!-- ================= PRODUCTS ================= -->
    <h2>🧵 Product Management</h2>

    <a href="product.php">📦 Manage Products</a>
    <a href="add_product_master.php">➕ Add New Product</a>
    <a href="manage_product_sections.php">📝 Manage Product Sections</a>
    <a href="add_product.php">➕ Add Product Content</a>

    <hr>

    <!-- ================= TEXTILE ================= -->
    <h2>🧵 Textile Data</h2>

    <a href="add_textile.php">➕ Add Textile</a>
    <a href="view_textiles.php">📊 View Textiles</a>

    <hr>

    <!-- ================= SETTINGS ================= -->
    <h2>⚙️ Settings</h2>

    <a href="logout.php">🚪 Logout</a>

</div>

</body>
</html>
