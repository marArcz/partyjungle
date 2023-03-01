<?php
include '../conn/conn.php';
include './includes/Session.php';

$name = $_POST['name'];
$category_id = $_POST['category_id'];
$price = $_POST['price'];
$stocks = $_POST['stocks'];
$description = $_POST['description'];

$target_dir = "assets/products/";
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $target_file);
$main_photo = $target_file;
$query = mysqli_prepare($con, "INSERT INTO products(product_name,category_id,price,stocks,description,photo) VALUES(?,?,?,?,?,?)");
$query->bind_param(
    "sissss",
    $name,
    $category_id,
    $price,
    $stocks,
    $description,
    $target_file
);
$category = mysqli_query($con, "SELECT * FROM categories WHERE id = $category_id")->fetch_assoc();
$category_name = $category['category_name'];


if ($query->execute()) {
    $product_id = mysqli_insert_id($con);
    if (!empty(basename($_FILES['product_photos']['name'][0]))) {
        $target_dir = "assets/products/";
        $query = mysqli_prepare($con, "INSERT INTO product_photos(product_id,photo) VALUES(?,?)");
        $photos_count = count($_FILES['product_photos']['name']);

        for ($i = 0; $i < $photos_count; $i++) {
            $target_file = $target_dir . basename($_FILES["product_photos"]["name"][$i]);
            move_uploaded_file($_FILES["product_photos"]["tmp_name"][$i], "../" . $target_file);

            $query->bind_param('is', $product_id, $target_file);
            if (!$query->execute()) {
                echo json_encode([
                    "success" => false,
                    "error" => mysqli_error($con)
                ]);
                exit();
            }
        }
    }

    // add variation
    $add_variation = mysqli_query($con,"INSERT INTO variations(product_id) VALUES($product_id)");
    $variation_id = mysqli_insert_id($con);
    $properties = [['Image',$main_photo],['Price',$price]];
    
    $add_property = mysqli_prepare($con,"INSERT INTO properties(product_id,property_name) VALUES(?,?)");
    foreach ($properties as $key => $property) {
        $add_property->bind_param('is',$product_id,$property[0]);
        $add_property->execute();
        $property_id = mysqli_insert_id($con);
        $value = $property[1];
        $add_value = mysqli_query($con,"INSERT INTO property_values(property_id,value,variation_)id) VALUES($property_id,'$value',$variation_id)");
    }
    // Session::insertSuccess("Successfully added!");
    // Session::redirectTo("products.php?category=$category_name");
    echo json_encode(["success" => true,"product_id"=>$product_id,"category"=>$category_name]);
    exit();
} else {
    echo json_encode(["success" => false]);

    exit();
}
