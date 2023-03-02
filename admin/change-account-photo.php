<?php
include '../conn/conn.php';
include './includes/Session.php';

$target_dir = "assets/uploads/";
$target_file = $target_dir . basename($_FILES['photo']['name']);
move_uploaded_file($_FILES['photo']['tmp_name'], "../" . $target_file);

$user_id = Session::getUser()['id'];
$query = mysqli_query($con, "UPDATE admin SET photo = '$target_file' WHERE id=$user_id");

if($query){
    Session::insertSuccess("Successfully updated!");
}else{
    Session::insertError();
}

Session::redirectTo("account.php");