<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $status = $_GET['status'];
    $transaction_no = $_GET['transaction_no'];

    $query = mysqli_query($con,"UPDATE orders SET status=$status WHERE transaction_no = '$transaction_no'");

    if($query){
        Session::insertSuccess("Successfully updated!");
    }else{
        Session::insertError();
    }

    Session::redirectTo("manage-order.php?transaction_no=$transaction_no");
?>