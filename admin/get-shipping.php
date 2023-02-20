<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $id = $_POST['id'];

    $query = mysqli_query($con,"SELECT * FROM shipping WHERE id = $id");

    $shipping = $query->fetch_assoc();

    echo json_encode($shipping);
    
?>