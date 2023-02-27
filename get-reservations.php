<?php 
include './conn/conn.php';
include './includes/Session.php';


$service_id = $_POST['service_id'];

$query = mysqli_query($con,"SELECT * FROM service_reservations WHERE status IN (SELECT status_code FROM reservation_status WHERE status_label != 'Cancelled' AND status_label != 'DECLINED')");
$reservations = [];

while($row = $query->fetch_assoc()){
    $row['owned'] = true;
    $row['service'] = mysqli_query($con,"SELECT * FROM services WHERE id = " . $row['service_id'])->fetch_assoc();
    $row['option'] = mysqli_query($con,"SELECT * FROM service_options WHERE id = " . $row['service_option_id'])->fetch_assoc();

    array_push($reservations,$row);
}

echo json_encode([
    "reservations"=>$reservations
]);
