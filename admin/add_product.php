<?php
session_start();

require_once __DIR__ . "/../includes/db.php";

/* =========================
   AUTH CHECK
========================= */
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

/* =========================
   INSERT DATA (SECURE)
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $content = $_POST["content"] ?? "";

    /* REMOVE SCRIPT TAGS */
    $content = preg_replace("#<script(.*?)>(.*?)</script>#is", "", $content);

    /* REMOVE JS EVENTS */
    $content = preg_replace('/on\w+="[^"]*"/i', "", $content);

    /* REMOVE javascript: links */
    $content = preg_replace('/href=["\']javascript:[^"\']*["\']/i', "", $content);

    /* ALLOW SAFE TAGS ONLY */
    $content = strip_tags($content, "<p><b><i><u><strong><em><ul><ol><li><br><img><a>");

    $stmt = $pdo->prepare("
        INSERT INTO product_pages (page_key, section, content)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([$_POST["page_key"], $_POST["section"], $content]);

    header("Location: product.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Product</title>

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

#editor {
    height: 300px;
    background: #fff;
}

.ql-editor img {
    max-width: 80%;
    display: block;
    margin: 15px auto;
    cursor: pointer;
}
</style>

</head>
<body>

<div class="container">

<h2>Add Product Content</h2>

<form method="POST">

<label>Product (Page Key)</label>
<select name="page_key" required>
<option value="">-- Select Product --</option>
<?php
$stmt = $pdo->query("SELECT * FROM products WHERE status=1 ORDER BY product_name ASC");
while($row = $stmt->fetch()){
    echo "<option value='".$row['product_key']."'>".$row['product_name']."</option>";
}
?>
</select>

<label>Section</label>
<select name="section">
    <option>About</option>
    <option>History and Evolution</option>
    <option>Heritage</option>
    <option>Product Features</option>
    <option>Physical Properties</option>
</select>

<label>Content</label>
<div id="editor"></div>

<input type="hidden" name="content" id="content">

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
            [{ 'indent': '-1'}, { 'indent': '+1' }],  // ✅ INDENT ADDED
            [{ 'align': [] }],
            ['link', 'image']
        ]
    }
});


/* IMAGE UPLOAD */
function selectLocalImage() {
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
                insertToEditor(result.location);
            }
        });
    };
}

function insertToEditor(url) {
    let range = quill.getSelection();
    if(!range){
        quill.focus();
        range = { index: quill.getLength() };
    }
    quill.insertEmbed(range.index, 'image', url);
}

/* OVERRIDE IMAGE BUTTON */
quill.getModule('toolbar').addHandler('image', selectLocalImage);

/* CLICK IMAGE → REPLACE */
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
