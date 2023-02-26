<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $id = $_GET['id'];

    $query = mysqli_query($con,"DELETE FROM service_options WHERE id = $id");

    if($query){
        Session::insertSuccess("Successfully deleted!");
    }else
    {
        Session::insertError();
    }
    $service_id = $_GET['service_id'];
    Session::redirectTo("manage-service.php?service_id=$service_id");
?>