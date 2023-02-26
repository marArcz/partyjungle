<?php
include '../conn/conn.php';
include './includes/Session.php';

$service_name = $_POST['service_name'];
$description = $_POST['description'];
$labels = $_POST['labels'];
$prices = $_POST['prices'];

if (!empty(basename($_FILES["photo"]["name"]))) {
    $target_dir = "assets/products/";
    $photo = $target_dir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $photo);
}else{
    $photo = "assets/images/logo1.jpg";
}

// insert service
$query = mysqli_query($con, "INSERT INTO services(name,description,photo) VALUES('$service_name','$description','$photo')");
if ($query) {
    $service_id = mysqli_insert_id($con);
    $add_option = mysqli_prepare($con, "INSERT INTO service_options(label,price,service_id) VALUES(?,?,?)");

    for ($i = 0; $i < count($labels); $i++) {
        $add_option->bind_param(
            'ssi',
            $labels[$i],
            $prices[$i],
            $service_id
        );

        if (!$add_option->execute()) {
            Session::insertError(mysqli_error($con));
            //remove service
            mysqli_query($con, "DELETE FROM services WHERE id=$service_id");
            Session::redirectTo("add-service-page.php");
            exit();
        }
    }
    Session::insertSuccess("Successfully added!");
    Session::redirectTo("services.php");
} else {
    Session::insertError(mysqli_error($con));
    Session::redirectTo("add-service-page.php");
}
