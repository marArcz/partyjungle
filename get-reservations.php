<?php 
include './conn/conn.php';
include './includes/Session.php';

$query = mysqli_query($con,"SELECT * FROM service_reservation");
$reservations = [];

while($row = $query->fetch_assoc()){
    array_push($reservations,$row);
}

echo json_encode([
    "reservations"=>$reservations
]);
