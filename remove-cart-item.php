<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    $query = mysqli_prepare($con,"DELETE FROM cart WHERE id = ?");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $cart_id = $_POST['cart_id'];
        $query->bind_param('i',$cart_id);
        echo json_encode([
            "success"=>$query->execute()?true:false
        ]);
    }else{
        $cart_id = $_GET['id'];
        $query->bind_param('i',$cart_id);
        if($query->execute()){
            
        }

        Session::redirectTo("cart.php");
    }

?>