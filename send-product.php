<?php 

include './conn/conn.php';
include './includes/Session.php';
include './includes/MessageTypes.php';
if (Session::getUser() == null) {
    echo json_encode([
        "success" => false,
        "error" => "unauthenticated"
    ]);
    exit();
}

$user_id = Session::getUser()['id'];
$is_admin = 0;

// look for conversation
$get_conversation = mysqli_query($con, "SELECT id FROM conversations WHERE user_id=$user_id");
if ($get_conversation->num_rows > 0) {
    $conversation_id = $get_conversation->fetch_array()[0];
} else {
    $query = mysqli_query($con, "INSERT INTO conversations(user_id) VALUES($user_id)");
    if (!$query) {
        echo json_encode([
            "success" => false,
            "error" => mysqli_error($con)
        ]);
        exit();
    } else {
        $conversation_id = mysqli_insert_id($con);
    }
}

//insert chat
$add_chat = 