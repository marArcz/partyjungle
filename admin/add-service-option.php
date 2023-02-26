<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $label = $_POST['label'];
    $price = $_POST['price'];
    $service_id = $_POST['service_id'];

    $query = mysqli_query($con,"INSERT INTO service_options(label,price,service_id) VALUES('$label','$price',$service_id)");

    if($query){
        Session::insertSuccess("Successfully added a service option!");
    }else{
        Session::insertError();
    }

    Session::redirectTo("manage-service.php?service_id=$service_id");
