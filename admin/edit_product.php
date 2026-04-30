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
   GET PRODUCT + SECTION
========================= */
$product = $_GET["product"] ?? "";
$section = $_GET["section"] ?? "";

if (!$product || !$section) {
    echo "Invalid request";
    exit();
}

/* =========================
   FETCH DATA
========================= */
$stmt = $pdo->prepare("SELECT * FROM product_pages WHERE page_key=? AND section=?");
$stmt->execute([$product, $section]);
$data = $stmt->fetch();

if (!$data) {
    echo "Record not found";
    exit();
}

/* =========================
   UPDATE DATA (SECURE)
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $content = $_POST["content"] ?? "";

    /* SECURITY CLEANING */
    $content = preg_replace("#<script(.*?)>(.*?)</script>#is", "", $content);
    $content = preg_replace('/on\w+="[^"]*"/i', "", $content);
    $content = preg_replace('/href=["\']javascript:[^"\']*["\']/i', "", $content);
    $content = strip_tags($content, "<p><b><i><u><strong><em><ul><ol><li><br><img><a>");

    $stmt = $pdo->prepare("
        UPDATE product_pages 
        SET section=?, content=? 
        WHERE page_key=? AND section=?
    ");

    $stmt->execute([
        $_POST["section"],
        $content,
        $_POST["page_key"],
        $section, // old section for WHERE
    ]);

    header("Location: manage_product_sections.php?product=" . $_POST["page_key"]);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Product</title>

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

<h2>Edit Product Content</h2>

<form method="POST">

<label>Product</label>
<select name="page_key">
<?php
$stmt = $pdo->query("SELECT * FROM products WHERE status=1 ORDER BY product_name ASC");
while($row = $stmt->fetch()){
    $selected = ($row['product_key'] == $data['page_key']) ? 'selected' : '';
    echo "<option value='".$row['product_key']."' $selected>".$row['product_name']."</option>";
}
?>
</select>

<label>Section</label>
<select name="section">
    <option <?= $data["section"] == "About" ? "selected" : "" ?>>About</option>
    <option <?= $data["section"] == "History and Evolution" ? "selected" : "" ?>>History and Evolution</option>
    <option <?= $data["section"] == "Heritage" ? "selected" : "" ?>>Heritage</option>
    <option <?= $data["section"] == "Product Features" ? "selected" : "" ?>>Product Features</option>
    <option <?= $data["section"] == "Physical Properties" ? "selected" : "" ?>>Physical Properties</option>
</select>

<label>Content</label>
<div id="editor"></div>

<input type="hidden" name="content" id="content">

<br>
<button type="submit">Update</button>

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


/* LOAD EXISTING CONTENT */
quill.root.innerHTML = <?= json_encode($data["content"]) ?>;

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
