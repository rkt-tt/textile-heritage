<?php
require_once __DIR__ . "/includes/db.php";
require_once __DIR__ . "/includes/header.php";
?>

<div class="content-area article-page">

<?php
$product = $_GET["product"] ?? "";
$page = $_GET["page"] ?? "";

/* =========================
   1. PRODUCT PAGES
========================= */
if ($product) {

    $stmt = $pdo->prepare("
        SELECT * FROM product_pages 
        WHERE page_key=? 
        ORDER BY 
            (section='About') DESC,
            (section='Image') DESC,
            id ASC
    ");

    $stmt->execute([$product]);
    $sections = $stmt->fetchAll();

    if ($sections) {

        foreach ($sections as $sec) {
            ?>
            <h2><?php echo $sec['section']; ?></h2>

            <div class="content-block">
                <?php echo $sec['content']; ?>
            </div>

            <?php
        }

    } else {
        echo "<h2>No product data found</h2>";
    }

    echo "
    <div class='product-disclaimer'>
        <strong>Disclaimer:</strong> The information provided on this platform is gathered directly from artisans within specific geographic clusters. While we strive for accuracy, details may vary from cluster to cluster.
    </div>
    ";

/* =========================
   2. CoE PAGES
========================= */
} elseif ($page) {

    $stmt = $pdo->prepare("SELECT * FROM coe_pages WHERE page_key=?");
    $stmt->execute([$page]);
    $data = $stmt->fetch();

    if ($data) {
        echo "<h2>" . htmlspecialchars($data["title"]) . "</h2>";
        echo "<div class='content-block article-content'>" . $data["content"] . "</div>";
    } else {
        echo "<h2>Page Not Found</h2>";
    }

/* =========================
   3. HOME PAGE (MAP)
========================= */
} else {
?>

<div class="main-layout">

    <!-- LEFT -->
    <div class="left-column">

        <div class="map-title">
            <h2>Heritage Map of India</h2>
            <p>Explore Traditional Textile Crafts Across Different States</p>
        </div>

        <div class="hero-section">
            <?php echo file_get_contents(__DIR__ . "/assets/maps/India.svg"); ?>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="right-column">
        <div class="chat-box" style="display: flex;">
            <?php include_once "includes/chatbot.php"; ?>
        </div>
    </div>

</div>

<?php } ?>

</div>

<!-- =========================
     MAP SCRIPT
========================= -->

<script>
document.addEventListener("DOMContentLoaded", function(){

    const states = document.querySelectorAll("svg path");

    const activeStates = [1, 8, 21];

    states.forEach((state) => {

        const id = parseInt(state.id);
        state.style.cursor = "pointer";

        if (!activeStates.includes(id)) {
            state.style.opacity = 0.3;
        }

        state.addEventListener("mouseenter", function(){
            state.style.fill = "#b38b59";
        });

        state.addEventListener("mouseleave", function(){
            state.style.fill = "";
        });

        state.addEventListener("click", function(){

            if (!activeStates.includes(id)) {
                alert("No products available for this state");
                return;
            }

            window.location.href = "state.php?state_id=" + id;
        });

    });

});
</script>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
