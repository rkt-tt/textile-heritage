<?php
require "includes/db.php";

$state_id = $_GET['state_id'] ?? 0;

$stmt = $pdo->prepare("
    SELECT t.craft_name, p.id as product_id, p.title
    FROM textiles t
    JOIN product_pages p ON t.product_id = p.id
    WHERE t.state_id = ?
");

$stmt->execute([$state_id]);
$rows = $stmt->fetchAll();

if (!$rows) {
    echo "<p>No textiles found.</p>";
    exit;
}

foreach ($rows as $row) {
    echo "<div class='card'>";
    
    echo "<h3>
        <a href='index.php?product=" . urlencode($row['title']) . "'>
            " . htmlspecialchars($row['craft_name']) . "
        </a>
    </h3>";
    
    echo "</div>";
}