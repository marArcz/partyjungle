<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $id = $_POST['id'];

    $query = mysqli_query($con,"DELETE FROM product_photos WHERE id = $id");

    if($query){
        // Session::insertSuccess("Successfully remo")
        echo json_encode((["success"=>true]));
    }else{
        echo json_encode((["success"=>false]));

    }
?>