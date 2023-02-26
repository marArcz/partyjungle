<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    $new_pass = password_hash(trim($_POST['new_pass']),PASSWORD_BCRYPT);
    $current_pass = $_POST['current_pass'];

    $user_pass = Session::getUser()['password'];
    $user_id = Session::getUser()['id'];
    
    if(!password_verify($current_pass,$user_pass)){
        $query = mysqli_query($con,"UPDATE users SET password = '$new_pass' WHERE id = $user_id");
        if(!$query){
            echo json_encode([
                "success"=>false,
                "error" => mysqli_error($con)
            ]);
        }else{
            echo json_encode([
                "success"=>true
            ]);
        }
    }else{
        echo json_encode([
            "success"=>false,
            "error" => "Current password is incorrect!"
        ]);
    }
?>