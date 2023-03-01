<?php
include '../conn/conn.php';

$product_id = $_POST['product_id'];

$count = count($_FILES['product_photos']['name']);
$target_dir = "assets/products/";
$query = mysqli_prepare($con, "INSERT INTO product_photos(product_id,photo) VALUES(?,?)");
for ($i = 0; $i < $count; $i++) {
    $file = $target_dir . basename($_FILES['product_photos']['name'][$i]);
    move_uploaded_file($_FILES['product_photos']['tmp_name'][$i], '../' . $file);

    $query->bind_param("is",$product_id,$file);
    $query->execute();
}

echo json_encode(['success'=>true]);


