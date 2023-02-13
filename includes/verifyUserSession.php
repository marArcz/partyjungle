<?php

    include_once './conn/conn.php';
    include_once './includes/Session.php';

    if(Session::getUser() !== null){
        $user = mysqli_query($con,"SELECT * FROM users WHERE id=" . Session::getUser()['id'])->fetch_assoc();
        if($user['is_verified'] === "0"){
            Session::redirectTo("send-verification.php");
        }
    }
?>