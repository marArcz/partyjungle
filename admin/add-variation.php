<?php
include '../conn/conn.php';
include './includes/Session.php';

$product_id = $_POST['product_id'];
$variation_id = $_POST['variation_id'];
// get properties
$get_properties = mysqli_query($con, "SELECT * FROM properties WHERE product_id = $product_id");
$add_property = mysqli_prepare($con, "INSERT INTO property_values(property_id,value,variation_id) VALUES(?,?,?)");
$update_property = mysqli_prepare($con, "UPDATE property_values SET value=? WHERE property_id=? AND variation_id = ?");
while ($row = $get_properties->fetch_assoc()) {
    $property_id = $row['id'];
    // get values
    $get_value = mysqli_query($con, "SELECT id FROM property_values WHERE property_id=$property_id AND variation_id=$variation_id");

    if ($get_value->num_rows > 0) { //if already has value
        // update value 
        if ($row['property_name'] == "Image") {
            // check if user uploaded an image
            if (isset($_FILES['image']) && !empty(basename($_FILES['image']['name']))) {
                // if has image
                $target_dir = "assets/products/";
                $file = $target_dir . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../' . $file);
                $value = $file;
            } else {
                $value = $_POST['img_src'];
            }
            $update_property->bind_param(
                'sii',
                $value,
                $property_id,
                $variation_id
            );
            $update_property->execute();
        } else {
            $value = $_POST[$row['property_name']];
            $update_property->bind_param(
                'sii',
                $value,
                $property_id,
                $variation_id
            );
            $update_property->execute();
        }
    } else {
        if ($row['property_name'] == "Image") {
            // check if user uploaded an image
            if (isset($_FILES['image']) && !empty(basename($_FILES['image']['name']))) {
                // if has image
                $target_dir = "assets/products/";
                $file = $target_dir . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../' . $file);
                $add_property->bind_param(
                    'isi',
                    $property_id,
                    $file,
                    $variation_id
                );
                $add_property->execute();
            } else {
                $value = $_POST['img_src'];
                $add_property->bind_param(
                    'isi',
                    $property_id,
                    $value,
                    $variation_id
                );
                $add_property->execute();
            }
        } else {
            $value = $_POST[$row['property_name']];
            $add_property->bind_param(
                'isi',
                $property_id,
                $value,
                $variation_id
            );
            $add_property->execute();
        }
    }
}

$get_property_values = mysqli_query($con,"SELECT property_values.value, properties.property_name FROM property_values INNER JOIN properties ON property_values.property_id = properties.id WHERE variation_id = $variation_id");
$properties = [];
while($row = $get_property_values->fetch_assoc()){
    array_push($properties,$row);
}
echo json_encode(['success' => true,'properties'=>$properties]);
