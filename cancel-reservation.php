<?php

include './conn/conn.php';
include './includes/Session.php';

$status = $_GET['status'];
$reservation_id = $_GET['id'];
$cancel_status =  mysqli_query($con,"SELECT status_code FROM reservation_status WHERE status_label = 'Cancelled'")->fetch_array()[0];
$query = mysqli_query($con,"UPDATE service_reservations SET status = $cancel_status WHERE id = $reservation_id");
if($query){
    Session::insertSuccess("Successfully cancelled reservation!");

}else{
    Session::insertError(mysqli_error($con));
}

Session::redirectTo("service-reservations.php?status=$status");
