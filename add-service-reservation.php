<?php
include './conn/conn.php';
include './includes/Session.php';


$service_id = $_POST['service_id'];
$option_id = $_POST['option_id'];
$date = $_POST['date'];
$time = $_POST['time'];
$user_id = Session::getUser()['id'];

$query = mysqli_query($con,"INSERT INTO service_reservations(service_id,service_option_id,date,time,user_id) VALUES($service_id,$option_id,'$date','$time',$user_id)");

if($query){
    Session::insertSuccess("Successfully submitted!");
    Session::redirectTo("service-reservations.php");
}else{
    Session::insertError();
    Session::redirectTo("schedule-service.php?service_id=$service_id&option_id=$option_id");
}