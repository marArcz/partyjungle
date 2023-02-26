<?php
include './conn/conn.php';
include './includes/Session.php';

//check if user is not authenticated
if (Session::getUser() == null) { //if no logged in user
    echo json_encode([
        'success' => false
    ]);
    exit();
}
$user_id = Session::getUser()['id'];

$filter = $_GET['filter'];
// get products that r added in cart
$query = mysqli_query($con, "SELECT * FROM products WHERE (product_name LIKE '%$filter%' OR category_id IN(SELECT id FROM categories WHERE category_name LIKE '%$filter%')) AND id IN (SELECT product_id FROM cart WHERE user_id = $user_id AND is_checked_out = 0)");
$all_products = [];
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        array_push($all_products, $row);
    }
}

// get other products that are not in cart
$query = mysqli_query($con, "SELECT * FROM products WHERE (product_name LIKE '%$filter%' OR category_id IN(SELECT id FROM categories WHERE category_name LIKE '%$filter%')) AND id NOT IN (SELECT product_id FROM cart WHERE user_id = $user_id AND is_checked_out = 0)");
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        array_push($all_products, $row);
    }
}


echo json_encode([
    'success' => true,
    'products' => $all_products
]);
