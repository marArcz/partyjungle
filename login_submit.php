<?php 
include_once './conn/conn.php';
include_once  './includes/Session.php';

$username = $_POST['username'];
$password = $_POST['password'];
$query = mysqli_query($con, "SELECT * FROM users WHERE username = '$username' LIMIT 1");

if($query->num_rows === 0){
    Session::insertError("No account found");
    Session::redirectTo("login.php");
}else{
    $user = $query->fetch_assoc();

    //check if password is correct
    if(password_verify($password,$user['password'])){
        Session::saveUserSession($user['id']);
        Session::insertSuccess("Successfully logged in!");
        Session::redirectTo("index.php");
    }else{
        Session::insertError("You entered an incorrect password!");
        Session::redirectTo("login.php");
    }
}
?>