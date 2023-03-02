<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $status = $_GET['status'];
    $product_id = $_GET['product_id'];

    $query = mysqli_query($con,"UPDATE products SET is_variation_enabled=$status WHERE id = $product_id");

    if(!$query){
        Session::insertError(mysqli_error($con));
    }

    Session::redirectTo("manage-product.php?product_id=$product_id&tab=Variations");
?>