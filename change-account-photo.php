<?php
include './conn/conn.php';
include './includes/Session.php';

$user_id = Session::getUser()['id'];
$target_dir = "assets/products/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);

$query = mysqli_query($con,"UPDATE users SET photo = '$target_file' WHERE id = $user_id");

if($query){
    Session::insertSuccess("Successfully changed!");
}else{
    Session::insertError();
}

Session::redirectTo("account.php");
