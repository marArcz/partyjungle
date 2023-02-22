<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    $user_id = Session::getUser()['id'];

    $query = mysqli_query($con,"SELECT * FROM shipping_address WHERE user_id = $user_id");

    if($query->num_rows > 0)  {
        $shipping_address = $query->fetch_assoc();
    }else{
        $shipping_address = null;
    }

    echo json_encode([
        "num_rows"=>$query->num_rows,
        "shipping_address"=>$shipping_address
    ]);
?>