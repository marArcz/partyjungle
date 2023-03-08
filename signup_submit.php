<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    $areas_covered = ['lemery','agoncillo','san luis','taal'];

    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $address = $_POST['address'];
        $town = $_POST['town'];
        $state = $_POST['state'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = password_hash(trim($_POST['password']),PASSWORD_BCRYPT);
        
        if(strtolower($state) == "batangas"){
            if(in_array(strtolower($town),$areas_covered)){
                $is_restricted = false;
            }else{
                $is_restricted = true;
            }
        }else{
            $is_restricted = true;
        }

        $query = mysqli_prepare($con,"INSERT INTO users(firstname,middlename,lastname,address,contact,email,username,password,town,state,is_restricted) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $query->bind_param(
            "ssssssssssi",
            $firstname,
            $middlename,
            $lastname,
            $address,
            $contact,
            $email,
            $username,
            $password,
            $town,
            $state,
            $is_restricted
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
