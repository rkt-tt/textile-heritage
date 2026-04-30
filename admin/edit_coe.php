<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/header.php";

/* GET PAGE KEY */
$page = $_GET['page'] ?? '';

if (!$page) {
    echo "<p style='color:red;'>No page selected</p>";
    exit;
}

/* FETCH DATA */
$stmt = $pdo->prepare("SELECT * FROM coe_pages WHERE page_key=?");
$stmt->execute([$page]);
$data = $stmt->fetch();

/* SAVE DATA */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];

    $stmt = $pdo->prepare("UPDATE coe_pages SET content=? WHERE page_key=?");
    $stmt->execute([$content, $page]);

    echo "<p style='color:green;'>Updated successfully</p>";

    // reload updated data
    $stmt->execute([$page]);
    $data = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit CoE Page</title>

<!-- QUILL CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
#editor {
    height: 300px;
}

/* Indentation */
.ql-indent-1 { padding-left: 40px; }
.ql-indent-2 { padding-left: 80px; }
.ql-indent-3 { padding-left: 120px; }

/* Lists */
.ql-editor ul,
.ql-editor ol {
    padding-left: 40px;
}

/* List spacing */
.ql-editor li {
    margin-bottom: 6px;
}

/* Image fix */
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
    <h2>Edit CoE Page: <?php echo htmlspecialchars($page); ?></h2>

    <form method="post">
        <input type="hidden" name="content" id="content">

        <!-- Editor -->
        <div id="editor"></div>

        <br>
        <button type="submit">Save</button>
    </form>
</div>

<!-- QUILL JS -->
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

/* Load existing content */
quill.root.innerHTML = <?php echo json_encode($data['content'] ?? ''); ?>;

/* Save */
document.querySelector("form").onsubmit = function() {
    document.getElementById("content").value = quill.root.innerHTML;
};
</script>

</body>
</html>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
