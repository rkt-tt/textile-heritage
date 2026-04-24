<!DOCTYPE html>

<html lang="en">
<head>
<meta charset="UTF-8">
<title>Textile Heritage</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Playfair+Display:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">

<style>

/* =========================
HEADER2 (RESPONSIVE CLEAN)
========================= */

.header2 {
position: sticky;
top: 0;
z-index: 9999;
width: 100%;
background: #fff;
border-bottom: 4px solid #b38b59;
padding: 10px 20px;
box-sizing: border-box;
box-shadow: 0 2px 8px rgba(0,0,0,0.08);
transition: all 0.3s ease;
}

.header2-inner {
display: flex;
align-items: center;
justify-content: space-between;
gap: 10px;
flex-wrap: nowrap;
}

/* FLEX SAFETY */
.header-left,
.header-center,
.header-right {
min-width: 0;
}

/* LEFT */
.header-left {
display: flex;
align-items: center;
gap: 10px;
flex: 2;
}

.header2-logo img {
height: 65px;
}

/* TEXT */
.header2-text h1 {
font-size: 20px;
margin: 0;
line-height: 1.2;
word-break: break-word;
text-align: center;    
}

.header2-text h4 {
font-size: 14px;
margin: 0;
}

/* CENTER (NAVBAR) */
.header-center {
flex: 1;
display: flex;
justify-content: center;
}

.navbar {
display: flex;
gap: 15px;
flex-wrap: wrap;
justify-content: center;
background: #e8f2fb;
padding: 8px 15px;
border-radius: 6px;
}

.navbar a {
text-decoration: none;
color: #1f3b57;
padding: 6px 10px;
}

.navbar a:hover {
background: #2c5d8a;
color: #fff;
border-radius: 4px;
}

/* RIGHT (LOGOS) */
.header-right {
flex: 1;
display: flex;
justify-content: flex-end;
gap: 10px;
}

.header-right img {
height: 50px;
max-width: 100%;
}

/* =========================
DROPDOWN (STABLE)
========================= */

.dropdown {
position: relative;
}

.dropdown-content {
display: none;
position: absolute;
top: 100%;
left: 0;

width: 260px;
max-width: 90vw;

background: #fff;
padding: 10px;
border-radius: 6px;

box-shadow: 0 4px 10px rgba(0,0,0,0.15);
z-index: 9999;

}

.dropdown:hover .dropdown-content {
display: block;
}

.dropdown-content a {
display: block;
padding: 8px 10px;
white-space: normal;
word-break: break-word;
}

/* =========================
TABLET (<=1024px)
========================= */

@media (max-width: 1024px) {

.header2-inner {
    flex-wrap: wrap;
    justify-content: center;
    text-align: center;
}

.header-left,
.header-center,
.header-right {
    flex: 100%;
    justify-content: center;
}

.header-left {
    flex-direction: column;
}

.header2-logo img {
    height: 55px;
}

.header-right img {
    height: 45px;
}

}

/* =========================
MOBILE (<=768px)
========================= */

@media (max-width: 768px) {

.header2-inner {
    flex-direction: column;
    align-items: center;
}

.header-left {
    flex-direction: column;
    text-align: center;
}

.header2-text h1 {
    font-size: 16px;
}

.header2-text h4 {
    font-size: 12px;
}

.navbar {
    flex-direction: column;
    width: 100%;
}

.navbar a {
    width: 100%;
    text-align: center;
}

.header-right {
    justify-content: center;
    margin-top: 10px;
}

.header-right img {
    height: 40px;
}

}

</style>

</head>

<body>

<!-- HEADER 2 -->

<div class="header2">


<div class="header2-inner">

    <!-- LEFT -->
    <div class="header-left">
        <div class="header2-logo">
            <img src="assets/images/logo3.jpg" alt="Logo">
        </div>

        <div class="header2-text">
            <h1>Centre for Sustainable Textile Heritage & Technology</h1>
            <h4>( Advancing Traditional Knowledge Through Modern Textile Engineering Research )</h4>
        </div>
    </div>

    <!-- CENTER -->
    <div class="header-center">
        <div class="navbar">

            <a href="index.php">Home</a>

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

    <!-- RIGHT -->
    <div class="header-right">
        <img src="assets/images/logo1.jpg">
        <img src="assets/images/logo2.jpg">
    </div>

</div>
</div>
    </body>
</html>
