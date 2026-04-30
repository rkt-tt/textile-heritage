<?php

require_once __DIR__ . "/../includes/db.php";

$id = $_POST['id'];
$field = $_POST['field'];
$value = $_POST['value'];

$allowed = ['state','craft_name','market','challenges'];

if(!in_array($field,$allowed)) die("Invalid");

$stmt = $pdo->prepare("UPDATE textiles SET $field=? WHERE id=?");
$stmt->execute([$value,$id]);

<script>
function updateField(el, field, id){
    let value = el.innerText;

    fetch("update_field.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`id=${id}&field=${field}&value=${encodeURIComponent(value)}`
    });
}
</script>
