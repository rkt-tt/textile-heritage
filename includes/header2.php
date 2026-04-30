<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Textile Heritage</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- HEADER 1 -->
<div class="header1">
    <div class="logo-section">
        <img src="assets/images/logo1.jpg">
        <img src="assets/images/logo2.jpg">
    </div>

    <!-- NAVBAR -->
    <div class="navbar">

        <a href="index.php">Home</a>

        <!-- CoE -->
        <div class="dropdown">
            <a href="#">CoE ▾</a>
            <div class="dropdown-content">
                <a href="index.php?page=about">About</a>
                <a href="index.php?page=vision">Vision</a>
                <a href="index.php?page=mission">Mission</a>
                <a href="index.php?page=objectives">Key Objectives</a>
                <a href="index.php?page=org">Organisational Diagram</a>
            </div>
        </div>

        <!-- Products (DYNAMIC) -->
        <div class="dropdown">
            <a href="#">Products ▾</a>

            <div class="dropdown-content">

            <?php
            require_once "includes/db.php";
            $stmt = $pdo->query("SELECT * FROM products WHERE status=1 ORDER BY product_name ASC");

            while ($row = $stmt->fetch()) {
                echo '<a href="index.php?product=' . $row["product_key"] . '">' . $row["product_name"] . "</a>";
            }
            ?>

            </div>
        </div>

    </div>
</div>

<!-- HEADER 2 -->
<div class="header2">
    <h1>Centre for Sustainable Textile Heritage & Technology</h1>
    <h4>( Advancing Traditional Knowledge Through Modern Textile Engineering Research )</h4>
</div>