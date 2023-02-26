<?php 
include './conn/conn.php';
include './includes/Session.php';

$id = Session::getUser()['id'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$username = $_POST['username'];


$query = mysqli_prepare($con,"UPDATE users SET firstname=?,middlename=?,lastname=?,address=?,email=?,contact=?,username=? WHERE id = ?");

$query->bind_param(
    'sssssssi',
    $firstname,
    $middlename,
    $lastname,
    $address,
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