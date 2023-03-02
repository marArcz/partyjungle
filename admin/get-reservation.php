<?php
include '../conn/conn.php';
include './includes/Session.php';

$id = $_POST['id'];
$query = mysqli_query($con, "SELECT service_reservations.*,reservation_status.status_code,reservation_status.status_label FROM service_reservations INNER JOIN reservation_status ON service_reservations.status = reservation_status.status_code WHERE service_reservations.id = $id");

$reservation = $query->fetch_assoc();
$reservation['str_date'] = date("M d, Y",strtotime($reservation['date']));
$reservation['str_time'] = date("h:i a",strtotime($reservation['time']));
$service_id = $reservation['service_id'];
$service_option_id = $reservation['service_option_id'];
$service = mysqli_query($con, "SELECT * FROM services WHERE id = $service_id")->fetch_assoc();
$option = mysqli_query($con, "SELECT * FROM service_options WHERE id = $service_option_id")->fetch_assoc();
$status = mysqli_query($con,"SELECT * FROM reservation_status WHERE status_code = ". $reservation['status'])->fetch_assoc();
echo json_encode([
    'reservation' => $reservation,
    'service' => $service,
    'option' => $option,
    'status'=>$status
]);
