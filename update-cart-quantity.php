<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    if(Session::getUser() === null){
        Session::redirectTo("login.php");
        exit();
    }

    $user_id = Session::getUser()['id'];

    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];
    $shipping_id = $_POST['shipping_id'];
    $query = mysqli_query($con,"UPDATE cart SET quantity = $quantity WHERE id=$cart_id");

    // get cart item info
    $item = mysqli_query($con,"SELECT * FROM cart WHERE id = $cart_id")->fetch_assoc();

    //get cart info
    $get_cart = mysqli_query($con,"SELECT * FROM cart WHERE user_id = $user_id");
    $subtotal = 0;
    while($row = $get_cart->fetch_assoc()){
        $subtotal += $row['price'] * $row['quantity'];
    }
    //get total cart items
    $total_items = mysqli_query($con,"SELECT SUM(quantity) FROM cart WHERE user_id = $user_id")->fetch_array()[0];
    //get shipping type
    $shipping = mysqli_query($con,"SELECT * FROm shipping WHERE id = $shipping_id")->fetch_assoc();
    

    echo json_encode([
        "success"=>$query?true:false,
        'item'=>$item,
        'total_items'=>$total_items,
        'subtotal'=>$subtotal,
        'shipping'=>$shipping
    ]);
?>