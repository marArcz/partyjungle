<?php
include '../conn/conn.php';
include './includes/Session.php';

$name = $_POST['name'];
$target_dir = "assets/products/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $target_file);

$query = mysqli_query($con,"INSERT INTO categories(category_name,category_photo) VALUES('$name','$target_file')");

if($query){
    Session::insertSuccess("Updated Successfully!");
}else{
    Session::insertError();
}

Session::redirectTo("categories.php");