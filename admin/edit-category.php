<?php
include '../conn/conn.php';
include './includes/Session.php';

$id = $_POST['id'];
$name = $_POST['name'];

if (!empty(basename($_FILES["photo"]["name"]))) {

    $target_dir = "assets/products/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $target_file);

    $query = mysqli_query($con,"UPDATE categories SET category_name='$name',category_photo='$target_file' WHERE id=$id");

}else{
    $query = mysqli_query($con,"UPDATE categories SET category_name='$name' WHERE id=$id");
}

if($query){
    Session::insertSuccess("Updated Successfully!");
}else{
    Session::insertError();
}

Session::redirectTo("categories.php");