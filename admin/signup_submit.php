<?php
if (isset($_POST['submit'])) {
    include '../conn/conn.php';
    include './includes/Session.php';

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);


    $query = mysqli_prepare($con, "INSERT INTO admin(firstname,middlename,lastname,email,contact,username,password) VALUES(?,?,?,?,?,?,?)");
    $query->bind_param(
        "sssssss",
        $firstname,
        $middlename,
        $lastname,
        $email,
        $contact,
        $username,
        $password
    );

    if ($query->execute()) {
        Session::insertSuccess("You successfully created an account!");
        Session::redirectTo("dashboard.php");
    } else {
        Session::insertError();
    }
} else {
    Session::redirectTo("signup.php");
}
