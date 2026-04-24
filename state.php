<?php
require_once __DIR__ . "/includes/db.php";
require_once __DIR__ . "/includes/header.php";


$state = $_GET["state"] ?? "";

echo "<h2>" . htmlspecialchars($state) . " Heritage</h2>";

$stmt = $pdo->prepare("SELECT * FROM textiles WHERE state=?");
$stmt->execute([$state]);

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch()) {
        echo "<div>
            <a href='product.php?id=" . $row["id"] . "'>
            " . htmlspecialchars($row["craft_name"]) . "
            </a>
        </div>";
    }
} else {
    echo "<p>No textile data found for this state.</p>";
}
?>
