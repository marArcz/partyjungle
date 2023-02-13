<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash(trim($_POST['password']),PASSWORD_BCRYPT);

        $query = mysqli_prepare($con,"INSERT INTO users(firstname,middlename,lastname,address,contact,email,username,password) VALUES(?,?,?,?,?,?,?,?)");
        $query->bind_param(
            "ssssssss",
            $firstname,
            $middlename,
            $lastname,
            $address,
            $contact,
            $email,
            $username,
            $password,
        );

        if($query->execute()){
            Session::insertSuccess("Successfully signed up!");
            Session::redirectTo("login.php");
        }else{
            Session::insertError("Error: " . mysqli_error($con));
            Session::redirectTo("signup.php");
        }
    }else{
        Session::redirectTo("signup.php");
    }
