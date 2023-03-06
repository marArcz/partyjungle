<?php 
include './conn/conn.php';
include './includes/Session.php';

$id = $_GET['id'];
$query = mysqli_query($con,"UPDATE reservations SET status = 1 WHERE id = $id");

if($query){
    Session::insertSuccess("Successfully cancelled!");
}else{
    Session::insertError();
}

Session::redirectTo("reservations.php");

?>