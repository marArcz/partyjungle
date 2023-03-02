<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    $user_id = $_GET['user_id'];

    $get_convo = mysqli_query($con,"SELECT * FROM conversations WHERE user_id = $user_id");

    if($get_convo->num_rows == 0){
        //create convo
        $query = mysqli_query($con,"INSERT INTO conversations(user_id) VALUES($user_id)");
        $convo_id = mysqli_insert_id($con);
    }else{
        $convo_id = $get_convo->fetch_assoc()['id'];
    }

    Session::redirectTo("chats.php?conversation_id=$convo_id");
?>