<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $product_id = $_GET['product_id'];
    $query = mysqli_query($con,"INSERT INTO variations(product_id) VALUES($product_id)");
    $product = mysqli_query($con,"SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
    if($query){
        // add properties
        $variation_id = mysqli_insert_id($con);
        $properties = [['Image',$product['photo']],['Price',$product['price']]];
        
        $add_property = mysqli_prepare($con,"INSERT INTO properties(product_id,property_name) VALUES(?,?)");
        foreach ($properties as $key => $property) {
            $add_property->bind_param('is',$product_id,$property[0]);
            $add_property->execute();
            $property_id = mysqli_insert_id($con);
            $value = $property[1];
            $add_value = mysqli_query($con,"INSERT INTO property_values(property_id,value,variation_id) VALUES($property_id,'$value',$variation_id)");
        }
        Session::insertSuccess("Successfully added!");
    }else{
        Session::insertError();
    }

    Session::redirectTo("manage-product.php?product_id=$product_id");
