<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    $shipping_type = $_POST['shipping_type'];

    $transaction_no = date("M") . "-" . date("y") . "-";
    $user_id = Session::getUser()['id'];

    $total_price = 0;
    $get_cart = mysqli_query($con,"SELECT * FROM cart WHERE user_id = $user_id");
    while($row = $get_cart->fetch_assoc()){
        $total_price += $row['price'] * $row['quantity'];
    }

    $shipping = mysqli_query($con,"SELECT * FROM shipping WHERE id = $shipping_type")->fetch_assoc();

    $query = mysqli_prepare($con,"INSERT INTO orders(user_id,total,shipping_address,shipping_type,shipping_fee) VALUES(?,?,?,?,?)");

    $shipping_address = Session::getUser()['address'];
    $shipping_fee = $shipping['price'];

    $query->bind_param(
        'issss',
        $user_id,
        $total_price,
        $shipping_address,
        $shipping_type,
        $shipping_fee
    );

    if($query->execute()){
        $id = mysqli_insert_id($con);

        for($i=strlen($id);$i<5;$i++){
            $transaction_no .= 0;
        }

        $transaction_no .= $id;

        mysqli_query($con,"UPDATE orders SET transaction_no='$transaction_no' WHERE id = $id");

        Session::insertSuccess("Successfully checked out!");
        Session::redirectTo("orders.php");
    }else{
        Session::insertError();
        Session::redirectTo("cart.php");

    }
?>