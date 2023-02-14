<?php 
    include '../conn/conn.php';

    $id = $_POST['id'];
    
    $query = mysqli_query($con,"SELECT * FROM categories WHERE id = $id");

    echo json_encode($query->fetch_assoc());
?>