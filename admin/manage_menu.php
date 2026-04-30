<?php

require_once __DIR__ . "/../includes/db.php";

$stmt = $pdo->query("SELECT * FROM coe_menu ORDER BY sort_order ASC");
?>

<h2>Manage Menu</h2>

<a href="add_menu.php">➕ Add Menu</a>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Title</th>
<th>Page</th>
<th>Order</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while ($row = $stmt->fetch()): ?>
<tr>

<td><?= $row["id"] ?></td>

<td contenteditable="true" onBlur="update(this,'title',<?= $row["id"] ?>)">
<?= $row["title"] ?>
</td>

<td><?= $row["page_key"] ?></td>

<td contenteditable="true" onBlur="update(this,'sort_order',<?= $row["id"] ?>)">
<?= $row["sort_order"] ?>
</td>

<td>
<button onclick="toggleStatus(<?= $row["id"] ?>)">
<?= $row["status"] ? "Active" : "Disabled" ?>
</button>
</td>

<td>
<a href="delete_menu.php?id=<?= $row["id"] ?>" onclick="return confirm('Delete?')">Delete</a>
</td>

</tr>
<?php endwhile; ?>
</table>

<script>
function update(el, field, id){
    fetch("update_menu.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`id=${id}&field=${field}&value=${el.innerText}`
    });
}

function toggleStatus(id){
    fetch("toggle_menu.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:`id=${id}`
    }).then(()=>location.reload());
}
</script>
