<?php
session_start();
require_once "../includes/db.php";

/* =========================
   AUTH CHECK
========================= */
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

$id = $_GET["id"] ?? "";

/* =========================
   FETCH DATA
========================= */
$stmt = $pdo->prepare("SELECT * FROM product_pages WHERE id=?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    echo "Record not found";
    exit();
}

/* =========================
   UPDATE DATA
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("
        UPDATE product_pages 
        SET page_key=?, section=?, content=? 
        WHERE id=?
    ");

    $stmt->execute([$_POST["page_key"], $_POST["section"], $_POST["content"], $id]);

    header("Location: manage_product_sections.php?product=" . $_POST["page_key"]);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Product</title>

<!-- QUILL CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
body {
    font-family: Arial;
    background: #f4f4f4;
}

.container {
    width: 800px;
    margin: 30px auto;
    background: #fff;
    padding: 20px;
    border-radius: 6px;
}

h2 {
    text-align: center;
}

input, select {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
}

/* Quill editor */
#editor {
    height: 300px;
    background: #fff;
}
</style>

</head>
<body>

<div class="container">

<h2>Edit Product Content</h2>

<form method="POST">

<!-- PRODUCT -->
<label>Product (Page Key)</label>
<input name="page_key" value="<?= htmlspecialchars($data["page_key"]) ?>" required>

<!-- SECTION -->
<label>Section</label>
<select name="section">
    <option <?= $data["section"] == "History and Evolution" ? "selected" : "" ?>>History and Evolution</option>
    <option <?= $data["section"] == "Heritage" ? "selected" : "" ?>>Heritage</option>
    <option <?= $data["section"] == "Product Features" ? "selected" : "" ?>>Product Features</option>
    <option <?= $data["section"] == "Physical Properties" ? "selected" : "" ?>>Physical Properties</option>
</select>

<!-- QUILL EDITOR -->
<label>Content</label>
<div id="editor"></div>

<!-- HIDDEN INPUT -->
<input type="hidden" name="content" id="content">

<br>
<button type="submit">Update</button>

</form>

</div>

<!-- QUILL JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            ['bold', 'italic'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link', 'image']
        ]
    }
});
quill.root.innerHTML = <?= json_encode($data["content"]) ?>;
/* =========================
   IMAGE UPLOAD FUNCTION
========================= */
function selectLocalImage() {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    input.click();

    input.onchange = () => {
        const file = input.files[0];
        const formData = new FormData();
        formData.append('image', file);

        fetch('upload_image.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if(result.location){
                insertToEditor(result.location);
            }
        });
    };
}

function insertToEditor(url) {
    const range = quill.getSelection();
    quill.insertEmbed(range.index, 'image', url);
}

/* OVERRIDE IMAGE BUTTON */
quill.getModule('toolbar').addHandler('image', selectLocalImage);

/* =========================
   REPLACE IMAGE ON CLICK
========================= */
quill.root.addEventListener('click', function(e){
    if(e.target.tagName === 'IMG'){
        if(confirm("Replace this image?")){
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.click();

            input.onchange = () => {
                const file = input.files[0];
                const formData = new FormData();
                formData.append('image', file);

                fetch('upload_image.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(result => {
                    if(result.location){
                        e.target.src = result.location;
                    }
                });
            };
        }
    }
});

/* SAVE CONTENT */
document.querySelector("form").onsubmit = function() {
    document.getElementById("content").value = quill.root.innerHTML;
};
</script>

</body>
</html>