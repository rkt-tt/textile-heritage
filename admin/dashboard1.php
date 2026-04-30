<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
?>

<h1>Admin Dashboard</h1>

<p>Welcome, <?= $_SESSION["admin"] ?></p>

<hr>

<h2>📌 CoE Management</h2>

<ul>
    <li><a href="manage_menu.php">📂 Manage CoE Menu</a></li>
    <li><a href="add_menu.php">➕ Add Menu Item</a></li>

    <li><a href="manage_pages.php">📄 Manage Pages</a></li>
    <li><a href="edit_page.php">➕ Add New Page</a></li>
    <li><a href="product.php">Manage Products</a></li>
    <li><a href="manage_product_sections.php">Manage Product Sections</a></li>
    <li><a href="manage_pages.php">Manage CoE Pages</a></li>
</ul>

<h2>🧵 Product Management</h2>

<ul>
    <li><a href="product.php">📦 Manage Products</a></li>
    <li><a href="add_product.php">➕ Add Product Content</a></li>
</ul>
<hr>

<ul>
    <li><a href="product.php">Manage Products</a></li>
    <li><a href="manage_product_sections.php">Manage Product Sections</a></li>
    <li><a href="manage_pages.php">Manage CoE Pages</a></li>
</ul>
<h2>🧵 Textile Data</h2>

<ul>
    <li><a href="add_textile.php">➕ Add Textile</a></li>
    <li><a href="dashboard.php">📊 View Textiles</a></li>
</ul>

<hr>

<h2>⚙️ Settings</h2>

<ul>
    <li><a href="logout.php">🚪 Logout</a></li>
</ul>