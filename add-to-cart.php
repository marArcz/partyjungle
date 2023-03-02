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

    $variation_id = null;
    if (isset($_POST['variation_id'])) {
        $variation_id = $_POST['variation_id'];
    }

    // check if product is already in cart
    $q = mysqli_query($con, "SELECT * FROM cart WHERE product_id = $product_id AND user_id = $user_id AND is_checked_out = 0 AND variation_id='$variation_id'");
    $exists = $q->num_rows > 0;

    if ($exists) {
        $cart = $q->fetch_assoc();
        $cart_id = $cart['id'];
        $quantity += $cart['quantity'];
        $query = mysqli_query($con, "UPDATE cart SET quantity=$quantity WHERE id = $cart_id");
    } else {
        // get category
        $category = mysqli_query($con, "SELECT * FROM categories WHERE id = $category_id")->fetch_assoc();
      
        $instruction = "";
        if (isset($_POST['instruction'])) {
            $instruction = $_POST['instruction'];
        }

        $get_properties = mysqli_query($con, "SELECT * FROM property_values WHERE property_id IN (SELECT id FROM properties WHERE product_id=$product_id)");
        if ($product['is_variation_enabled'] == 1 && $get_properties->num_rows > 0) {
            $variation_id = $_POST['variation_id'];
            $price_property = mysqli_query($con, "SELECT * FROM property_values WHERE variation_id = $variation_id AND property_id IN (SELECT id FROM properties WHERE property_name = 'Price' AND product_id = $product_id)")->fetch_assoc();
            $price = $price_property['value'];
        } else {
            $price = $product['price'];
        }

        $variation = "";
        if (isset($_POST['variation'])) {
            $variation = $_POST['variation'];
        }

        //add to cart
        // $query = mysqli_query($con, "INSERT INTO cart(product_id, product_name,product_photo,category_id,price,quantity,user_id,variation_id,instruction,variation) VALUES($product_id,'$product_name','$photo',$category_id,'$price',$quantity,$user_id,$variation_id,'$instruction','$variation')");
        $query = mysqli_prepare($con, "INSERT INTO cart(product_id, product_name,product_photo,category_id,price,quantity,user_id,variation_id,instruction,variation) VALUES(?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param(
            'ssssssssss',
            $product_id,
            $product_name,
            $photo,
            $category_id,
            $price,
            $quantity,
            $user_id,
            $variation_id,
            $instruction,
            $variation
        );
        $query->execute();
    }



    if ($query) {
        // Session::insertSuccess("Successfully added to cart!");
        Session::redirectTo("cart.php");
    } else {
        Session::insertError();
        Session::redirectTo("product-details.php?id=$product_id");
    }
}
