<?php
include './conn/conn.php';
include './includes/Session.php';

$shipping_type = $_POST['shipping_type'];

$transaction_no = "PJ".date("M") . date("y");
$user_id = Session::getUser()['id'];

$total_price = 0;
$get_cart = mysqli_query($con, "SELECT * FROM cart WHERE user_id = $user_id AND is_checked_out = 0");
while ($row = $get_cart->fetch_assoc()) {
    $total_price += $row['price'] * $row['quantity'];
}

$shipping = mysqli_query($con, "SELECT * FROM shipping WHERE id = $shipping_type")->fetch_assoc();

$query = mysqli_prepare($con, "INSERT INTO orders(user_id,total,shipping_address,shipping_id,shipping_fee,payment_method) VALUES(?,?,?,?,?,?)");


$get_address = mysqli_query($con,"SELECT * FROM shipping_address WHERE user_id = $user_id");
if($get_address->num_rows == 0){
    Session::redirectTo("cart.php");
    Session::insertError("No shipping address found!");
    exit();
}
$address = $get_address->fetch_assoc();
$shipping_address = $address['region'] . ' ' . $address['province'] . ' ' . $address['city'] . ' ' . $address['zip_code'] .' ' . $address['barangay'] . ' ' . $address['street_name'] . ' ' . $address['house_no'];
$shipping_fee = $shipping['price'];
$payment_method_id = $_POST['payment_method'];
$payment_method = mysqli_query($con,"SELECT * FROM payment_method WHERE id = $payment_method_id")->fetch_assoc();

$query->bind_param(
    'issssi',
    $user_id,
    $total_price,
    $shipping_address,
    $shipping_type,
    $shipping_fee,
    $payment_method_id
);

if ($query->execute()) {
    $order_id = mysqli_insert_id($con);

    for ($i = strlen($order_id); $i < 10; $i++) {
        $transaction_no .= 0;
    }

    $transaction_no .= $order_id;
    $transaction_no = strtoupper($transaction_no);
    mysqli_query($con, "UPDATE orders SET transaction_no='$transaction_no' WHERE id = $order_id");


    // insert order details

    $get_cart = mysqli_query($con, "SELECT * FROM cart WHERE user_id = $user_id AND is_checked_out = 0");
    while ($row = $get_cart->fetch_assoc()) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $product_photo = $row['product_photo'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $variation_id = $row['variation_id'];
        $instruction = $row['instruction'];
        $variation = $row['variation'];
        $category_id = $row['category_id'];

        $add_details = mysqli_prepare($con, "INSERT INTO order_details(order_id,product_id,product_name,product_photo,price,quantity,variation_id,instruction,variation,category_id) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $add_details->bind_param(
            "iisssisssi",
            $order_id,
            $product_id,
            $product_name,
            $product_photo,
            $price,
            $quantity,
            $variation_id,
            $instruction,
            $variation,
            $category_id
        );
        if (!$add_details->execute()) { //if failed
            mysqli_query($con, "DELETE FROM orders WHERE id = $order_id"); //remove order
            Session::insertError();
            Session::redirectTo("cart.php");
            exit();
        }
    }

    //clear cart after checking out
    $query = mysqli_query($con,"UPDATE cart SET is_checked_out=1 WHERE user_id = $user_id");

    Session::insertSuccess("Successfully checked out!");
    Session::redirectTo("orders.php");
} else {
    Session::insertError();
    Session::redirectTo("cart.php");
}
