<?php
include './conn/conn.php';

$variation_id = $_GET['variation_id'];
$query = mysqli_query($con, "SELECT * FROM variations WHERE id = $variation_id");

$variation = $query->fetch_assoc();
$product_id = $variation['product_id'];
$properties = [];
$image = mysqli_query($con,"SELECT * FROM property_values WHERE variation_id = $variation_id AND property_id IN (SELECT id FROM properties WHERE product_id = $product_id AND property_name='Image')")->fetch_assoc()['value'];
$price = mysqli_query($con,"SELECT * FROM property_values WHERE variation_id = $variation_id AND property_id IN (SELECT id FROM properties WHERE product_id = $product_id AND property_name='Price')")->fetch_assoc()['value'];

$get_properties = mysqli_query($con,"SELECT * FROM property_values WHERE variation_id = $variation_id AND property_id IN (SELECT id FROM properties WHERE product_id = $product_id AND property_name != 'Price' AND property_name != 'Image')");

while($row = $get_properties->fetch_assoc()){
    array_push($properties, $row);
}

$data['image'] = $image;
$data['price'] = $price;
$data['properties'] = $properties;

echo json_encode($data);