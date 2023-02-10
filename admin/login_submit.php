<?php
include '../conn/conn.php';
include './includes/Session.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($con, "SELECT * FROM admin WHERE username = '$username' LIMIT 1");

    if ($query->num_rows == 0) {
        Session::insertError("No account found.");
        Session::redirectTo("index.php");
    } else {
        $user = $query->fetch_assoc();
        $user_pass = $user['password'];

        //check if password match
        if (password_verify($password, $user_pass)) {
            Session::saveUserSession($user['id']);
            Session::insertSuccess("Welcome admin!");
            Session::redirectTo("dashboard.php");
        } else {
            Session::insertError("You entered an incorrect password");
            Session::redirectTo("index.php?login_username=$username");
        }
    }
} else {
    Session::redirectTo("index.php");
}
