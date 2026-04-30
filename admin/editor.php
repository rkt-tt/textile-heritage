<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/header.php";

/* TYPE: product OR coe */
$type = $_GET['type'] ?? '';
$key  = $_GET['key'] ?? '';

if (!$type || !$key) {
    echo "<p style='color:red;'>Missing type or key</p>";
    exit;
}

/* FETCH DATA */
if ($type == "product") {
    $stmt = $pdo->prepare("SELECT * FROM product_pages WHERE page_key=? LIMIT 1");
} else {
    $stmt = $pdo->prepare("SELECT * FROM coe_pages WHERE page_key=? LIMIT 1");
}

$stmt->execute([$key]);
$data = $stmt->fetch();

/* SAVE */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $content = $_POST['content'];

    if ($type == "product") {
        $stmt = $pdo->prepare("UPDATE product_pages SET content=? WHERE page_key=?");
    } else {
        $stmt = $pdo->prepare("UPDATE coe_pages SET content=? WHERE page_key=?");
    }

    $stmt->execute([$content, $key]);

    echo "<p style='color:green;'>Saved successfully</p>";

    // reload
    $stmt->execute([$key]);
    $data = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Unified Editor</title>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
#editor { height: 300px; }

/* Indentation */
.ql-indent-1 { padding-left: 40px; }
.ql-indent-2 { padding-left: 80px; }
.ql-indent-3 { padding-left: 120px; }

/* Lists */
.ql-editor ul,
.ql-editor ol {
    padding-left: 40px;
}

.ql-editor li {
    margin-bottom: 6px;
}

/* Images */
.ql-editor img {
    display: block;
    margin: 10px auto;
    max-width: 100%;
    height: auto;
}
</style>
</head>

<body>

<div class="content-area">
    <h2>Editor (<?php echo htmlspecialchars($type); ?>: <?php echo htmlspecialchars($key); ?>)</h2>

    <form method="post">
        <input type="hidden" name="content" id="content">

        <div id="editor"></div>

        <br>
        <button type="submit">Save</button>
    </form>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'align': [] }],
            ['link', 'image']
        ]
    }
});

/* Load content */
quill.root.innerHTML = <?php echo json_encode($data['content'] ?? ''); ?>;

/* Save */
document.querySelector("form").onsubmit = function() {
    document.getElementById("content").value = quill.root.innerHTML;
};
</script>

</body>
</html>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
