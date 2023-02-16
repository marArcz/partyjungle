<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    if(isset($_POST['submit'])){
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $user_id = Session::getUser()['id'];

        //add to cart
        $query = mysqli_query($con,"INSERT INTO cart(product_id, product_name,product_photo,category_id,price,quantity,user_id)");


    }
?>