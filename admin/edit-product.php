<?php
include '../conn/conn.php';
include './includes/Session.php';

function add_reservation_to_cart(int $product_id, int $new_stocks)
{
    global $con;

    $get_reservations = mysqli_query($con, "SELECT * FROM reservations WHERE product_id = $product_id AND status = 0 ORDER BY id DESC");
    while ($reservation = $get_reservations->fetch_assoc()) {
        $user_id = $reservation['user_id'];
        $variation_id = $reservation['variation_id'];
        $instruction = $reservation['instruction'];
        $quantity = $reservation['quantity'];
        $variation = $reservation['variation'];
        $reservation_id = $reservation['id'];
        
        if ($new_stocks >= $reservation['quantity']) {
            $quantity = $reservation['quantity'];
            $new_stocks -= $reservation['quantity'];
            $product = mysqli_query($con,"SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
            $product_name = $product['product_name'];
            $category_id = $product['category_id'];
            $price = $product['price'];
            $photo = $product['photo'];

            $query = mysqli_query($con, "INSERT INTO cart(product_id,variation_id,instruction,quantity,variation,user_id,product_name,price,product_photo,category_id) VALUES($product_id,$variation_id,'$instruction',$quantity,'$variation',$user_id,'$product_name','$price','$photo',$category_id)");
            $update_reservation = mysqli_query($con,"UPDATE reservations SET status = 2 WHERE id = $reservation_id");
        } 
    }
}


$id = $_POST['id'];
$name = $_POST['name'];
$category_id = $_POST['category_id'];
$price = $_POST['price'];
$stocks = $_POST['stocks'];
$description = $_POST['description'];

$old_stock = mysqli_query($con,"SELECT stocks FROM products WHERE id = $id")->fetch_array()[0];

if (!empty(basename($_FILES["photo"]["name"]))) {
    $target_dir = "assets/products/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $target_file);
    $query = mysqli_query($con, "UPDATE products SET product_name='$name',category_id=$category_id,price='$price',stocks=$stocks,description='$description',photo='$target_file' WHERE id = $id");
} else {
    $query = mysqli_query($con, "UPDATE products SET product_name='$name',category_id=$category_id,price='$price',stocks=$stocks,description='$description' WHERE id = $id");
}


if ($query) {
    if(intval($stocks) >= intval($old_stock)){
        add_reservation_to_cart($id,$stocks);
        echo "new stocks-> old: $old_stock, new: $stocks";
    }else{
        echo "no stocks-> old: $old_stock, new: $stocks";
    }

    if (isset($_POST['is_featured'])) {
        $is_featured = $_POST['is_featured'];
        mysqli_query($con, "UPDATE products SET is_featured = 1 WHERE id =$id");
    } else {
        mysqli_query($con, "UPDATE products SET is_featured = 0 WHERE id =$id");
    }
    Session::insertSuccess("Successfully updated!");
} else {
    Session::insertError();
}

$category = mysqli_query($con, "SELECT * FROM categories WHERE id = $category_id")->fetch_assoc();
$category_name = $category['category_name'];
Session::redirectTo("manage-product.php?product_id=$id");
