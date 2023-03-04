<?php 
include './conn/conn.php';
include './includes/Session.php';

$user_id = Session::getUser()['id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$variation = isset($_POST['variation']) ? $_POST['variation'] : null;
$variation_id = isset($_POST['variation_id']) ? $_POST['variation_id'] : null;
$query = mysqli_query($con,"INSERT INTO reservations(user_id,product_id,quantity,variation,variation_id) VALUES($user_id,$product_id,$quantity,'$variation','$variation_id')");

if($query){
    Session::insertSuccess("Successfully added!");
}else{
    Session::insertError();
}

Session::redirectTo("product-details.php?id=$product_id");

?>