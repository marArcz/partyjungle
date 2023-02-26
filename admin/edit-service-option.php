<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $label = $_POST['label'];
    $price = $_POST['price'];
    $id = $_POST['id'];
    $service_id = $_POST['service_id'];
    $query = mysqli_query($con,"UPDATE service_options SET label='$label',price='$price' WHERE id = $id");

    if($query){
        Session::insertSuccess("Successfully updated service option!");
    }else{
        Session::insertError();
    }

    Session::redirectTo("manage-service.php?service_id=$service_id");
