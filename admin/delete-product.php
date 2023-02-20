<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $id = $_GET['id'];

    $query = mysqli_query($con,"DELETE FROM products WHERE id = $id");

    if($query){
        Session::insertSuccess("Successfully deleted!");
    }else{
        Session::insertError();
    }

    Session::redirectTo("products.php");
?>