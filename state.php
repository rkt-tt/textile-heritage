<?php
require_once __DIR__ . "/includes/db.php";
require_once __DIR__ . "/includes/header.php";

/* =========================
   GET & VALIDATE STATE ID
========================= */
$state_id = isset($_GET['state_id']) ? (int)$_GET['state_id'] : 0;

if ($state_id <= 0) {
    echo "<div class='content-area'><h2>Invalid request</h2></div>";
    require_once __DIR__ . "/includes/footer.php";
    exit;
}

/* =========================
   FETCH STATE
========================= */
$stmt = $pdo->prepare("SELECT id, state_name FROM states WHERE id = ?");
$stmt->execute([$state_id]);
$state = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$state || empty($state['state_name'])) {
    echo "<div class='content-area'><h2>State not found</h2></div>";
    require_once __DIR__ . "/includes/footer.php";
    exit;
}

/* =========================
   FETCH PRODUCTS FOR STATE
   (JOIN products + product_pages)
========================= */
$stmt = $pdo->prepare("
    SELECT DISTINCT p.product_name, p.product_key
    FROM products p
    JOIN product_pages pp ON p.product_key = pp.page_key
    WHERE pp.state_id = ?
    ORDER BY p.product_name ASC
");
$stmt->execute([$state_id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content-area">

<h2><?php echo htmlspecialchars($state['state_name']); ?></h2>

<?php if (!empty($items)): ?>

    <div class="product-grid">

        <?php foreach ($items as $it): ?>

            <div class="product-card">
                <h3><?php echo htmlspecialchars($it['product_name']); ?></h3>

                <a href="index.php?product=<?php echo urlencode($it['product_key']); ?>" 
                   class="btn btn-theme">
                    View Details
                </a>
            </div>

        <?php endforeach; ?>

    </div>

<?php else: ?>

    <p>No products available for this state.</p>

<?php endif; ?>


</div>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
