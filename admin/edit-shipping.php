<?php
include '../conn/conn.php';
include './includes/Session.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $query = mysqli_query($con, "UPDATE shipping SET description='$description', price='$price' WHERE id = $id");

    if ($query) {
        Session::insertSuccess("Successfully updated!");
    } else {
        Session::insertError();
    }

    Session::redirectTo("shipping.php");
}else{
    Session::redirectTo("shipping.php");
}
