<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    $products = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $shipping = $_POST['shipping'];

    $transaction_no = date("M") . "-" . date("y") . "";
    $user_id = Session::getUser()['id'];

    $total_price = 0;
    $get_cart = mysqli_query($con,"SELECT * FROM cart WHERE user_id = $user_id");
    while($row = $get_cart->fetch_assoc()){
        $total_price += $row['price'] * $row['quantity'];
    }

    $shipping = mysqli_query($con,"SELECT * FROM shipping WHERE id = $shipping");

    $query = mysqli_prepare($con,"INSERT INTO orders(user_id,total,shipping_address,shipping_type,shipping_fee) VALUES(?,?,?,?,?)");

    $shipping_address = Session::getUser()['address'];
    $shipping_fee = $shipping['fee'];

    $query->bind_param(
        'issss',
        $user_id,
        $total_price,
        $shipping_address,
        $shipping_type,
        $shipping_fee
    );

?>