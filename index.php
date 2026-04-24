<?php
require_once __DIR__ . "/includes/db.php";
require_once __DIR__ . "/includes/header.php";
?>

<div class="content-area">

<?php
$product = $_GET["product"] ?? "";
$page = $_GET["page"] ?? "";
/* =========================
   1. PRODUCT PAGES (FIFO)
========================= */ if ($product) {
    $stmt = $pdo->prepare("
        SELECT * FROM product_pages 
        WHERE page_key=? 
        ORDER BY id ASC
    ");
    $stmt->execute([$product]);
    $sections = $stmt->fetchAll();
    if ($sections) {
        foreach ($sections as $sec) {
            echo "<h2>" . htmlspecialchars($sec["section"]) . "</h2>";
            echo "<div class='content-block'>" . $sec["content"] . "</div>";
        }
    } else {
        echo "<h2>No product data found</h2>";
    }
    /* =========================
   2. CoE PAGES
========================= */
} elseif ($page) {
    $stmt = $pdo->prepare("SELECT * FROM coe_pages WHERE page_key=?");
    $stmt->execute([$page]);
    $data = $stmt->fetch();
    if ($data) {
        echo "<h2>" . htmlspecialchars($data["title"]) . "</h2>";
        echo "<div class='content-block'>" . $data["content"] . "</div>";
    } else {
        echo "<h2>Page Not Found</h2>";
    }
    /* =========================
   3. DEFAULT (MAP)
========================= */
} else {
     ?>

    <div class="main-layout">

    <!-- LEFT (80%) -->
    <div class="left-column">

        <div class="map-title">
            <h2>Heritage Map of India</h2>
            <p>Explore Traditional Textile Crafts Across Different States</p>
        </div>

        <div class="hero-section">
    <?php
    echo file_get_contents(__DIR__ . "/assets/maps/India.svg");
    ?>
</div>

    </div>

    <!-- RIGHT (20%) -->
    <div class="right-column">

        <div class="chat-box">
            <h4>Chat Support</h4>
            <p>Coming soon...</p>
        </div>

    </div>


    <?php
   /* $svgPath = __DIR__ . "/assets/maps/India1.svg";
    if (file_exists($svgPath)) {
        echo file_get_contents($svgPath);
    } else {
        echo "<p style='color:red;'>Map file missing</p>";
    } */
    ?>
    </div> 
<?
<?php
}
?>
</div>

<?php

/* =========================
   STATE LINKS (OPTIONAL)
========================= */ 

$stmt = $pdo->query(
    "SELECT DISTINCT state FROM textiles"
);
while ($row = $stmt->fetch()) {
    echo "<div class='state-box'>
        <a href='state.php?state=" .
        urlencode($row["state"]) .
        "'>
        " .
        htmlspecialchars($row["state"]) .
        "
        </a>
    </div>";
}
?>

<!-- =========================
     MAP SCRIPT (UPDATED)
========================= -->
<script>
document.addEventListener("DOMContentLoaded", function(){

    const states = document.querySelectorAll("svg path");

    states.forEach((state) => {

        state.style.cursor = "pointer";

        // HOVER EFFECT
        state.addEventListener("mouseenter", function(){
            state.style.fill = "#b38b59";
        });

        state.addEventListener("mouseleave", function(){
            state.style.fill = "";
        });

        // CLICK → FILTER PAGE
        state.addEventListener("click", function(){

            const id = state.id.replace("state_", "");

            window.location.href = "index.php?state=" + id;

        });

    });

});
</script>
<?php require_once __DIR__ . "/includes/footer.php"; ?>
