<?php 
    include './conn/conn.php';
    include './includes/Session.php';

    if(Session::getUser() == null){
        echo json_encode([
            'success'=>false,
            'error'=>'unauthenticated'
        ]);
    }

    $user_id = Session::getUser()['id'];

    $query = mysqli_query($con,"UPDATE chats SET status=2 WHERE is_admin = 1 AND conversation_id IN (SELECT id FROM conversations WHERE user_id = $user_id)");

    if($query){
        echo json_encode(['success'=>true]);
    }else{
        echo json_encode(['success'=>false]);
    }
?>