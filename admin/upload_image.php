<?php
session_start();

if (!isset($_SESSION["admin"])) {
    http_response_code(403);
    exit();
}

if (isset($_FILES["image"])) {
    $file = $_FILES["image"];

    $ext = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $allowed = ["jpg", "jpeg", "png", "gif"];

    if (!in_array($ext, $allowed)) {
        echo json_encode(["error" => "Invalid file"]);
        exit();
    }

    $filename = time() . "_" . rand(1000, 9999) . "." . $ext;

    $target = "../assets/images/" . $filename;

    if (move_uploaded_file($file["tmp_name"], $target)) {
        echo json_encode([
            "location" => "assets/images/" . $filename,
        ]);
    } else {
        echo json_encode(["error" => "Upload failed"]);
    }
}
?>
