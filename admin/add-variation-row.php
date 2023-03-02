<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $product_id = $_GET['product_id'];
    $product = mysqli_query($con,"SELECT * FROM products WHERE id = $product_id")->fetch_assoc();

    $query = mysqli_query($con,"INSERT INTO variations(product_id) VALUES($product_id)");
    if($query){
        // add properties
        $variation_id = mysqli_insert_id($con);
        $properties = [['Image',$product['photo']],['Price',$product['price']]];
        
        $add_property = mysqli_prepare($con,"INSERT INTO properties(product_id,property_name) VALUES(?,?)");
        $image_property_id = mysqli_query($con,"SELECT id FROM properties WHERE product_id = $product_id AND property_name = 'Image'")->fetch_array()[0];
        $price_property_id = mysqli_query($con,"SELECT id FROM properties WHERE product_id = $product_id AND property_name = 'Price'")->fetch_array()[0];
       
        $image = $product['photo'];
        $price = $product['price'];
        $add_image = mysqli_query($con,"INSERT INTO property_values(property_id,value,variation_id) VALUES($image_property_id,'$image',$variation_id)");
        $add_price = mysqli_query($con,"INSERT INTO property_values(property_id,value,variation_id) VALUES($price_property_id,'$price',$variation_id)");

        Session::insertSuccess("Successfully added!");
    }else{
        Session::insertError();
    }

    Session::redirectTo("manage-product.php?product_id=$product_id&tab=Variations");