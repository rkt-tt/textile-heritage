<?php
session_start();

require_once __DIR__ . "/../includes/db.php";


if (!isset($_SESSION["admin"])) {
    die("Unauthorized");
}

$id = $_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM textiles WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if ($_POST) {
    $stmt = $pdo->prepare("
    UPDATE textiles SET 
    state=?, craft_name=?, history=?, market=?, challenges=?
    WHERE id=?
    ");

    $stmt->execute([
        $_POST["state"],
        $_POST["craft_name"],
        $_POST["history"],
        $_POST["market"],
        $_POST["challenges"],
        $id,
    ]);

    echo "Updated!";
}
?>

<form method="POST">
State: <input name="state" value="<?= $data["state"] ?>"><br>
Craft: <input name="craft_name" value="<?= $data["craft_name"] ?>"><br>
History:<br>
<textarea name="history"><?= $data["history"] ?></textarea><br>
Market:<br>
<textarea name="market"><?= $data["market"] ?></textarea><br>
Challenges:<br>
<textarea name="challenges"><?= $data["challenges"] ?></textarea><br>

<button>Update</button>
</form>
