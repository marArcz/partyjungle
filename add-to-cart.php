<?php
include './conn/conn.php';
include './includes/Session.php';

if (Session::getUser() === null) {
    Session::redirectTo("login.php");
    Session::insertError("You need to signin first!");
    exit();
}

if (isset($_POST['submit'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $user_id = Session::getUser()['id'];
    //get product info
    $product = mysqli_query($con, "SELECT * FROM products WHERE id = $product_id")->fetch_assoc();

    $product_name = $product['product_name'];
    $photo = $product['photo'];
    $category_id = $product['category_id'];
    $price = $product['price'];


    // check if product is already in cart
    $q = mysqli_query($con, "SELECT * FROM cart WHERE product_id = $product_id && user_id=$user_id AND is_checked_out=0");
    $exists = $q->num_rows > 0;

    if ($exists) {
        $cart = $q->fetch_assoc();
        $cart_id = $cart['id'];
        $quantity += $cart['quantity'];
        $query = mysqli_query($con, "UPDATE cart SET quantity=$quantity WHERE id = $cart_id");
    } else {
        // get category
        $category = mysqli_query($con,"SELECT * FROM categories WHERE id = $category_id")->fetch_assoc();
        $variation_id = null;
        if(isset($_POST['variation_id'])){
            $variation_id = $_POST['variation_id'];
        }
        $instruction = "";
        if(isset($_POST['instruction'])){
            $instruction = $_POST['instruction'];
        }

        //add to cart
        $query = mysqli_query($con, "INSERT INTO cart(product_id, product_name,product_photo,category_id,price,quantity,user_id,variation_id,instruction) VALUES($product_id,'$product_name','$photo',$category_id,'$price',$quantity,$user_id,$variation_id,'$instruction')");
        
    }



    if ($query) {
        // Session::insertSuccess("Successfully added to cart!");
        Session::redirectTo("cart.php");
    } else {
        Session::insertError();
        Session::redirectTo("product-details.php?id=$product_id");
    }
}
