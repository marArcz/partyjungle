<?php 
include '../conn/conn.php';
include './includes/Session.php';

$id = Session::getUser()['id'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$username = $_POST['username'];


$query = mysqli_prepare($con,"UPDATE admin SET firstname=?,middlename=?,lastname=?,email=?,contact=?,username=? WHERE id = ?");

$query->bind_param(
    'ssssssi',
    $firstname,
    $middlename,
    $lastname,
    $email,
    $contact,
    $username,
    $id
);

if($query->execute()){
    Session::insertSuccess("Successfully updated!");
}else{
    Session::insertError();
}

Session::redirectTo("account.php");