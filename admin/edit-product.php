<?php
include '../conn/conn.php';
include './includes/Session.php';

$id = $_POST['id'];
$name = $_POST['name'];
$category_id = $_POST['category_id'];
$price = $_POST['price'];
$stocks = $_POST['stocks'];
$description = $_POST['description'];

if (!empty(basename($_FILES["photo"]["name"]))) {
    $target_dir = "assets/products/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $target_file);
    $query = mysqli_query($con, "UPDATE products SET product_name='$name',category_id=$category_id,price='$price',stocks=$stocks,description='$description',photo='$target_file' WHERE id = $id");
} else {
    $query = mysqli_query($con, "UPDATE products SET product_name='$name',category_id=$category_id,price='$price',stocks=$stocks,description='$description' WHERE id = $id");
}


if ($query) {
    Session::insertSuccess("Successfully updated!");
} else {
    Session::insertError();
}

$category = mysqli_query($con, "SELECT * FROM categories WHERE id = $category_id")->fetch_assoc();
$category_name = $category['category_name'];
Session::redirectTo("manage-product.php?product_id=$id");
