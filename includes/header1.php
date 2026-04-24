<?php include "includes/db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Textile Heritage</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">

<style>

</style>

</head>

<body>

<!-- HEADER 1 -->

    <div class="logo-section">
        <img src="assets/images/logo1.jpg">
        <img src="assets/images/logo2.jpg">
    </div>
<!-- NAVBAR -->
    <div class="navbar">
        <a href="index.php">Home</a>

        <div class="dropdown">
    <a href="#" id="coeMenu">CoE ▾</a>

    <div class="dropdown-content" id="coeSubmenu">
        <?php
        $stmt = $pdo->query("SELECT * FROM coe_menu WHERE status=1 ORDER BY sort_order ASC");

        while ($m = $stmt->fetch()) {
            echo '<a href="index.php?page=' . $m["page_key"] . '">' . $m["title"] . "</a>";
        }
        ?>
    </div>
</div>
        
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


<!-- HEADER 2 -->
<div class="header2">
    <h1>Centre for Sustainable Textile Heritage &amp; Technology</h1>
    <h4>( Advancing Traditional Knowledge Through Modern Textile Engineering Research )</h4>
</div>

<!-- ✅ JS AFTER HTML (IMPORTANT) -->
<script>
document.addEventListener("DOMContentLoaded", function(){

    const coeMenu = document.getElementById("coeMenu");
    const submenu = document.getElementById("coeSubmenu");
    const dropdown = document.querySelector(".dropdown");

    coeMenu.addEventListener("click", function(e){
        e.preventDefault();
        submenu.classList.toggle("show");
    });

    document.addEventListener("click", function(e){
        if(!dropdown.contains(e.target)){
            submenu.classList.remove("show");
        }
    });

});
</script>
    <script>
document.getElementById("productMenu").addEventListener("click", function(e){
    e.preventDefault();
    document.getElementById("productSubmenu").classList.toggle("show");
});
</script>

</body>
</html>