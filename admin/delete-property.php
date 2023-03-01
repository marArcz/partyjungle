<?php 
    include '../conn/conn.php';
    include './includes/Session.php';
    
    $id = $_GET['id'];
    $product_id = $_GET['product_id'];
    $query = mysqli_query($con,"DELETE FROM properties WHERE id =$id");

    if($query){
        Session::insertSuccess("Successfully deleted!");
    }else{
        Session::insertError();
    }

    Session::redirectTo("manage-product.php?product_id=$product_id&tab=Variations");
?>