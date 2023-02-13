<?php 
    include './conn/conn.php';

    $email = $_POST['email'];
    $username = $_POST['username'];

    $email_exists = false;
    $username_exists = false;

    // check if user exists with same email
    $query = mysqli_query($con,"SELECT * FROM users WHERE email = '$email'");
    $email_exists = $query->num_rows > 0;

    // check if user exists with same username
    $query = mysqli_query($con,"SELECT * FROM users WHERE username = '$username'");
    $username_exists = $query->num_rows > 0;

    $allowed = !$email_exists && !$username_exists;

    echo json_encode([
        "username_exists"=>$username_exists,
        "email_exists"=>$email_exists,
        "allowed"=>$allowed
    ]);
?>