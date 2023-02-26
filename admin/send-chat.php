<?php
include '../conn/conn.php';
include './includes/MessageTypes.php';


$user_id = $_POST['user_id'];
$is_admin = 1;

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

if (isset($_POST['message'])) {
    $message = $_POST['message'];
    if (!empty($_FILES['photos']['name'])) {
        $type = MessageTypes::$MESSAGE_WITH_ATTACHMENTS;
    } else {
        $type = MessageTypes::$PLAIN_MESSAGE;
    }
} else {
    $message = "";
    $type = MessageTypes::$ATTACHMENTS;
}
// insert chat
$query = mysqli_query($con, "INSERT INTO chat(user_id, conversation_id,message,type,is_admin) VALUES($user_id, $conversation_id,'$message',$type,$is_admin)");
$chat_id = mysqli_insert_id($con);
if (!$query) {
    echo json_encode([
        "success" => false,
        "error" => mysqli_error($con)
    ]);
    exit();
}


if (!empty($_FILES['photos']['name'])) {
    $target_dir = "assets/products/";
    $query = mysqli_prepare($con, "INSERT INTO chat_attachments(chat_id,photo) VALUES(?,?)");
    $photos_count = count($_FILES['photos']['name']);

    for ($i = 0; $i < $photos_count; $i++) {
        $target_file = $target_dir . basename($_FILES["photos"]["name"][$i]);
        move_uploaded_file($_FILES["photos"]["tmp_name"][$i], "../".$target_file);

        $query->bind_param('is', $chat_id, $target_file);
        if (!$query->execute()) {
            echo json_encode([
                "success" => false,
                "error" => mysqli_error($con)
            ]);
            exit();
        }
    }

}

// get chats
$get_chats = mysqli_query($con, "SELECT * FROM chat WHERE conversation_id = $conversation_id ORDER BY id DESC");
$chats = [];
while ($row = $get_chats->fetch_assoc()) {
    $chat_id = $row['id'];

    if($row['type'] == MessageTypes::$PRODUCTS || $row['type'] == MessageTypes::$MESSAGE_WITH_ATTACHMENTS){
        $query = mysqli_query($con,"SELECT * FROM chat_attachments WHERE chat_id = $chat_id");
        $attachments = [];
        while($attachment = $query->fetch_assoc()){
            array_push($attachments,$attachment);
        }
        $row['attachments'] = $attachments;
    }
    array_push($chats, $row);
}

echo json_encode([
    "conversation_id" => $conversation_id,
    "chats" => $chats
]);
