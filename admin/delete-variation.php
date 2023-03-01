<?php 
    include '../conn/conn.php';

    $variation_id = $_POST['variation_id'];
    
    $query = mysqli_query($con,"DELETE FROM variations WHERE id = $variation_id");

    echo json_encode(['success'=>$query?true:false]);
?>