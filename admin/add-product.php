<?php
include '../conn/conn.php';
include './includes/Session.php';

$name = $_POST['name'];
$category_id = $_POST['category_id'];
$price = $_POST['price'];
$stocks = $_POST['stocks'];
$description = $_POST['description'];

$target_dir = "../assets/products/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

$query = mysqli_prepare($con, "INSERT INTO products(product_name,category_id,price,stocks,description,photo) VALUES(?,?,?,?,?,?)");
$query->bind_param(
    "sissss",
    $name,
    $category_id,
    $price,
    $stocks,
    $description,
    $target_file
);

if($query->execute()){
    Session::insertSuccess("Successfully added!");
    Session::redirectTo("products.php");
    exit();
}
else{
    Session::insertError();
    Session::redirectTo("products.php");
    exit();
}
