<?php
include './conn/conn.php';
include './includes/Session.php';

$id = $_POST['id'];

$query = mysqli_query($con, "SELECT * FROM shipping WHERE id = $id");
$shipping = $query->fetch_assoc();

$total_price = 0;
$user_id = Session::getUser()['id'];
$query = mysqli_query($con, "SELECT * FROM cart WHERE user_id = $user_id");
while ($row = $query->fetch_assoc()) {
    $total_price += $row['price'] * $row['quantity'];
}
$total_price += $shipping['price'];


echo json_encode([
    'shipping' => $shipping,
    'total_price' => $total_price
]);
