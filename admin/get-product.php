<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $id = $_POST['id'];

    //get product
    $query = mysqli_query($con,"SELECT products.*,categories.category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");
    $product = $query->fetch_assoc();

    echo json_encode($product);
?>