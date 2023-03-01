<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $id = $_GET['id'];
    $status = $_GET['status'];
    $status = mysqli_query($con,"SELECT status_code FROM reservation_status WHERE status_label = '$status'")->fetch_array()[0];
    $query = mysqli_query($con,"UPDATE service_reservations SET status = $status WHERE id = $id");

    if($query){
        Session::insertSuccess("Successfully updated!");
    }else{
        Session::insertError();
    }

    Session::redirectTo("service-reservations.php?status=$status");
?>