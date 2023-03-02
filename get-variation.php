<?php
include './conn/conn.php';

$variation_id = $_GET['variation_id'];
$query = mysqli_query($con, "SELECT * FROM variations WHERE id = $variation_id");

$variation = $query->fetch_assoc();
$product_id = $variation['product_id'];

$variations = [];

while ($variation = $get_variations->fetch_assoc()) {
    $variation_id = $variation['id'];
    $get_property_values = mysqli_query($con, "SELECT property_values.value, properties.property_name FROM property_values INNER JOIN properties ON property_values.property_id = properties.id WHERE variation_id = $variation_id AND properties.property_name != 'Image' AND properties.property_name != 'Price' ORDER BY properties.property_name DESC");
    $count = $get_property_values->num_rows;
    $i = 0;
    $val = "";
    while ($property = $get_property_values->fetch_assoc()) {
        $val .= $property['value'] . ($i + 1 == $count ? '' : ', ');
        $i++;
    }
    // get price
    $get_price = mysqli_query($con,"SELECT * FROM property_values WHERE variation_id = $variation_id AND property_id IN (SELECT id FROM properties WHERE product_id = $product_id AND property_name = 'Price')");
    $price_property = $get_price->fetch_assoc();

    $variation['variation'] = $val;
    $variation['price'] = $price_property['value'];
    array_push($variations,$variation);

}

echo json_encode([
    "variations"=>$variations
])
?>