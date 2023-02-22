<?php
include './conn/conn.php';
include './includes/Session.php';

if (Session::getUser() === null) {
    echo json_encode([
        "success" => false,
        "error" => "Unauthenticated"
    ]);
    exit();
}

$user_id = Session::getUser()['id'];
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$region = $_POST['region'];
$province = $_POST['province'];
$city = $_POST['city'];
$barangay = $_POST['barangay'];
$street_name = $_POST['street_name'];
$house_no = $_POST['house_no'];
$zip_code = $_POST['zip_code'];
$region_code = $_POST['region_code'];
$province_code = $_POST['province_code'];
$city_code = $_POST['city_code'];
$barangay_code = $_POST['barangay_code'];

$get_address = mysqli_query($con, "SELECT * FROM shipping_address WHERE user_id = $user_id");
if ($get_address->num_rows > 0) {
    $id = $get_address->fetch_assoc()['id'];
    $query = mysqli_prepare($con, "UPDATE shipping_address SET fullname=?,phone=?,region=?,province=?,city=?,barangay=?,street_name=?,house_no=?,zip_code=?,region_code=?,province_code=?,city_code=?,barangay_code=? WHERE id = ?");
    $query->bind_param(
        'sssssssssssssi',
        $fullname,
        $phone,
        $region,
        $province,
        $city,
        $barangay,
        $street_name,
        $house_no,
        $zip_code,
        $region_code,
        $province_code,
        $city_code,
        $barangay_code,
        $id
    );

    if ($query->execute()) {
        echo json_encode([
            "success" => true,
            "region" => $region,
            "fullname" => $fullname,
            "phone" => $phone,
            "province" => $province,
            "city" => $city,
            "barangay" => $barangay,
            "street_name" => $street_name,
            "house_no" => $house_no,
            "zip_code" => $zip_code,
            "shipping_address_id" => $id
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "error" => mysqli_error($con)
        ]);
    }

} else {
    $query = mysqli_prepare($con, "INSERT INTO shipping_address(user_id,region,province,city,barangay,street_name,house_no,zip_code,fullname,phone,region_code,province_code,city_code,barangay_code) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $query->bind_param(
        'isssssssssssss',
        $user_id,
        $region,
        $province,
        $city,
        $barangay,
        $street_name,
        $house_no,
        $zip_code,
        $fullname,
        $phone,
        $region_code,
        $province_code,
        $city_code,
        $barangay_code
    );

    if ($query->execute()) {
        $id = mysqli_insert_id($con);
        echo json_encode([
            "success" => true,
            "region" => $region,
            "fullname" => $fullname,
            "phone" => $phone,
            "province" => $province,
            "city" => $city,
            "barangay" => $barangay,
            "street_name" => $street_name,
            "house_no" => $house_no,
            "zip_code" => $zip_code,
            "shipping_address_id" => $id
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "error" => mysqli_error($con)
        ]);
    }
}
