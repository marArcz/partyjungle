<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    $code = $_POST['code'];

    $user = Session::getUser();
    $user_id = $user['id'];

    $query = mysqli_query($con, "SELECT * FROM verification_codes WHERE user_id=$user_id AND expiry > NOW() AND status = 0 ORDER BY id DESC LIMIT 1");

    if($query->num_rows === 0){
        Session::insertSuccess("Verification code has expired, we have now sent you a new one please check your inbox.");
        Session::redirectTo("send-verification.php");
    }else{
        $v_code = $query->fetch_assoc();
        if($code == $v_code['code']){
            //update user status
            $query = mysqli_query($con,"UPDATE users SET is_verified = 1 WHERE id = $user_id");
            Session::redirectTo("index.php");
        }else{
            Session::insertError("Incorrect verification code!");
            Session::redirectTo("verify-account.php");
        }
    }

?>