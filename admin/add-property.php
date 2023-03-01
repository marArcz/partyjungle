<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $product_id = $_POST['product_id'];
    $property_name = $_POST['property_name'];

    $query = mysqli_query($con,"INSERT INTO properties(property_name,product_id) VALUES('$property_name',$product_id)");

    if($query){
        $property_id = mysqli_insert_id($con);
        $property = mysqli_query($con,"SELECT * FROM properties WHERE id = $property_id")->fetch_assoc();
        // echo json_encode(['success'=>true,"property"=>$property]);
        Session::insertSuccess("Successfully added!");
    }else{
        // echo json_encode(['success'=>false]);
        Session::insertError();
    }
    Session::redirectTo("manage-product.php?tab=Variations&product_id=$product_id");
?>