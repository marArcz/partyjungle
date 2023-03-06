<?php 
include './conn/conn.php';
include './includes/Session.php';

$user_id = Session::getUser()['id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$variation = isset($_POST['variation']) ? $_POST['variation'] : null;
$variation_id = isset($_POST['variation_id']) ? $_POST['variation_id'] : null;

// check if product is reserved
$get_reservation = mysqli_query($con,"SELECT id,quantity FROM reservations WHERE product_id = $product_id AND user_id = $user_id AND variation_id=$variation_id AND status = 0");
if($get_reservation->num_rows > 0){
    $reservation = $get_reservation->fetch_assoc();
    $quantity = $reservation['quantity'] + $quantity;
    $id = $reservation['id'];
    $query = mysqli_query($con,"UPDATE reservations SET quantity = $quantity WHERE id = $id");
}else{
    $query = mysqli_query($con,"INSERT INTO reservations(user_id,product_id,quantity,variation,variation_id) VALUES($user_id,$product_id,$quantity,'$variation','$variation_id')");
}


if($query){
    Session::insertSuccess("Successfully added!");
}else{
    Session::insertError();
}

Session::redirectTo("reservations.php");
