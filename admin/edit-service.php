<?php
include '../conn/conn.php';
include './includes/Session.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];

if (!empty(basename($_FILES["photo"]["name"]))) {
    $target_dir = "assets/products/";
    $photo = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $photo);
    $query = mysqli_query($con, "UPDATE services SET name='$name',description='$description',photo='$photo' WHERE id = $id");
} else {
    $query = mysqli_query($con, "UPDATE services SET name='$name',description='$description' WHERE id = $id");
}


if ($query) {
    Session::insertSuccess("Successfully updated service!");
} else {
    Session::insertError();
}
Session::redirectTo("manage-service.php?service_id=$id");
