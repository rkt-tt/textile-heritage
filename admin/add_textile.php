<?php
session_start();

require_once __DIR__ . "/../includes/db.php";

if (!isset($_SESSION["admin"])) {
    die("Unauthorized");
}

if ($_POST) {
    $stmt = $pdo->prepare("
    INSERT INTO textiles (state, craft_name, history)
    VALUES (?, ?, ?)
    ");

    $stmt->execute([$_POST["state"], $_POST["craft_name"], $_POST["history"]]);

    echo "Saved!";
}
?>

<form method="POST">
<input name="state" placeholder="State">
<input name="craft_name" placeholder="Craft Name">
<textarea name="history"></textarea>
<input type="file" name="images[]" multiple>
<button>Save</button>
</form>
