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
$get_conversation = mysqli_query($con, "SELECT id FROM conversations WHERE user_id=$user_id");

if ($get_conversation->num_rows > 0) {
    $user_id = Session::getUser()['id'];

    // get chats
    $get_chats = mysqli_query($con, "SELECT * FROM chat WHERE conversation_id = $conversation_id ORDER BY id DESC");
    $chats = [];
    while ($row = $get_chats->fetch_assoc()) {
        $chat_id = $row['id'];

        if ($row['type'] == MessageTypes::$PRODUCTS || $row['type'] == MessageTypes::$MESSAGE_WITH_ATTACHMENTS) {
            $query = mysqli_query($con, "SELECT * FROM chat_attachments WHERE chat_id = $chat_id");
            $attachments = [];
            while ($attachment = $query->fetch_assoc()) {
                array_push($attachments, $attachment);
            }
            $row['attachments'] = $attachments;
        }
        array_push($chats, $row);
    }

    echo json_encode([
        "conversation_id" => $conversation_id,
        "chats" => $chats
    ]);
} else {
    echo json_encode([
        "conversation_id" => null,
        "chats" => []
    ]);
};
