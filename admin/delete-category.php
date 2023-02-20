<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $id = $_GET['id'];

    $query = mysqli_query($con,"DELETE FROM categories WHERE id = $id");

    if($query){
        Session::insertSuccess("Successfully deleted!");
    }else{
        Session::insertError();
    }

    Session::redirectTo("categories.php");
?>