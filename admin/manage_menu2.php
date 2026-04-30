aa<?php
require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/header.php";

/* ================= SAVE MENU ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id         = $_POST['id'] ?? '';
    $title      = $_POST['title'];
    $link       = $_POST['link'];
    $content    = $_POST['content'];
    $parent_id  = $_POST['parent_id'] ?? 0;
    $sort_order = $_POST['sort_order'] ?? 0;

    if ($id) {
        $stmt = $pdo->prepare("UPDATE menu SET title=?, link=?, content=?, parent_id=?, sort_order=? WHERE id=?");
        $stmt->execute([$title, $link, $content, $parent_id, $sort_order, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO menu (title, link, content, parent_id, sort_order) VALUES (?,?,?,?,?)");
        $stmt->execute([$title, $link, $content, $parent_id, $sort_order]);
    }

    echo "<p style='color:green;'>Saved successfully</p>";
}

/* ================= EDIT MODE ================= */
$editData = null;

if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare("SELECT * FROM menu WHERE id=?");
    $stmt->execute([$_GET['edit']]);
    $editData = $stmt->fetch();
}

/* ================= FETCH MENU ================= */
$menus = $pdo->query("SELECT * FROM menu ORDER BY sort_order ASC")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Manage Menu</title>

<!-- QUILL CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
#editor {
    height: 250px;
}

/* Indentation */
.ql-indent-1 { padding-left: 40px; }
.ql-indent-2 { padding-left: 80px; }

/* Lists */
.ql-editor ul,
.ql-editor ol {
    padding-left: 40px;
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
    <h2>Manage Menu</h2>

    <!-- ================= FORM ================= -->
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">
        <input type="hidden" name="content" id="content">

        <label>Title</label><br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($editData['title'] ?? ''); ?>" required><br><br>

        <label>Link</label><br>
        <input type="text" name="link" value="<?php echo htmlspecialchars($editData['link'] ?? ''); ?>"><br><br>

        <label>Parent Menu</label><br>
        <select name="parent_id">
            <option value="0">Main Menu</option>
            <?php foreach ($menus as $m): ?>
                <option value="<?php echo $m['id']; ?>"
                    <?php if (($editData['parent_id'] ?? '') == $m['id']) echo "selected"; ?>>
                    <?php echo htmlspecialchars($m['title']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Sort Order</label><br>
        <input type="number" name="sort_order" value="<?php echo $editData['sort_order'] ?? 0; ?>"><br><br>

        <label>Content (Description)</label><br>

        <!-- QUILL EDITOR -->
        <div id="editor"></div>

        <br>
        <button type="submit">Save</button>
    </form>

    <hr>

    <!-- ================= MENU LIST ================= -->
    <h3>Menu List</h3>

    <?php foreach ($menus as $m): ?>
        <div style="padding:8px; border-bottom:1px solid #ccc;">
            <b><?php echo htmlspecialchars($m['title']); ?></b>
            (<?php echo htmlspecialchars($m['link']); ?>)
            <a href="?edit=<?php echo $m['id']; ?>">Edit</a>
        </div>
    <?php endforeach; ?>

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
var existingContent = <?php echo json_encode($editData['content'] ?? ''); ?>;
quill.root.innerHTML = existingContent;

/* Save content */
document.querySelector("form").onsubmit = function() {
    document.getElementById("content").value = quill.root.innerHTML;
};
</script>

</body>
</html>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
