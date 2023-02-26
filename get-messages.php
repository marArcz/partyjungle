<?php
include './conn/conn.php';
include './includes/Session.php';
include './includes/MessageTypes.php';
?>

<?php
$user_id = Session::getUser()['id'];
$get_conversation = mysqli_query($con, "SELECT id FROM conversations WHERE user_id = $user_id");
if ($get_conversation->num_rows == 0) {
    $query = mysqli_query($con, "INSERT INTO conversations(user_id) VALUES($user_id)");
    $conversation_id = mysqli_insert_id($con);
} else {
    $conversation_id = $get_conversation->fetch_assoc()['id'];
}

$query = mysqli_query($con, "SELECT * FROM chat WHERE conversation_id = $conversation_id ORDER BY id ASC");
$update_status = mysqli_query($con, "UPDATE chat SET status = 2 WHERE conversation_id = $conversation_id AND is_admin=1");
$num_of_messages = $query->num_rows;
$i = 1;
while ($row = $query->fetch_assoc()) {
    if ($row['is_admin'] == 1 && $row['type'] == MessageTypes::$PLAIN_MESSAGE) {
?>
        <div class="chat-item ">
            <div class="chat-sender">
                <img src="./assets/images/ban_img1.png" class="img-fluid" width="30" alt="">
            </div>
            <div class="chat-content bg-light text-dark border shadow-sm">
                <?php echo $row['message'] ?>
            </div>
            <p class="my-1 date text-secondary fw-light"><small> <?php echo date("M d, Y", strtotime($row['created_at'])) ?></small></p>
        </div>
    <?php
    } else if ($row['is_admin'] == 1 && ($row['type'] == MessageTypes::$MESSAGE_WITH_ATTACHMENTS || $row['type'] == MessageTypes::$ATTACHMENTS)) {
    ?>
        <div class="chat-item ">
            <div class="chat-sender">
                <img src="./assets/images/ban_img1.png" class="img-fluid" width="30" alt="">
            </div>
            <div class="chat-content bg-light text-dark border shadow-sm">
                <div class="row">
                    <?php
                    $chat_id = $row['id'];
                    $get_attachments = mysqli_query($con, "SELECT id,photo FROM chat_attachments WHERE chat_id = $chat_id");
                    while ($attachment = $get_attachments->fetch_assoc()) {
                    ?>
                        <div class="col-6">
                            <img src="<?php echo $attachment['photo'] ?>" class="img-fluid" alt="">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php echo $row['message'] ?>
            </div>
            <p class="my-1 date text-secondary fw-light"><small><?php echo date("M d, Y", strtotime($row['created_at'])) ?></small></p>
        </div>
    <?php
    } else if ($row['is_admin'] == 0 && $row['type'] == MessageTypes::$PLAIN_MESSAGE) {
    ?>
        <div class="chat-item owned text-end my-3">

            <div class="chat-content bg-light mt-0 text-dark border shadow-sm">
                <?php echo $row['message'] ?>
            </div>
            <p class="mt-1 mb-0 date text-secondary fw-light">
                <small>
                    <?php echo date("M d, Y", strtotime($row['created_at'])) ?>
                </small>
                <?php
                if ($i == $num_of_messages && $row['is_admin'] == '0') {
                ?>
                    <?php
                    if ($row['status'] == 0) {
                    ?>
                        <small class="ms-2">
                            <i class="bx bx-check-circle fs-6"></i>
                        </small>

                    <?php
                    } else if ($row['status'] == 1) {
                    ?>
                        <br>
                        <small class="ms-2">
                            Delivered <i class="bx bxs-check-circle"></i>
                        </small>
                    <?php
                    } else {
                    ?>
                        <br>
                        <small>
                            Seen
                        </small>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </p>

        </div>
    <?php
    } else if ($row['is_admin'] == 0 && ($row['type'] == MessageTypes::$MESSAGE_WITH_ATTACHMENTS || $row['type'] == MessageTypes::$ATTACHMENTS)) {
        $chat_id = $row['id'];
        $get_attachments = mysqli_query($con, "SELECT id,photo FROM chat_attachments WHERE chat_id = $chat_id");
    ?>
        <div class="chat-item owned">
            <div class="chat-content bg-light text-dark border shadow-sm">
                <div class="row my-2 <?php echo $get_attachments->num_rows > 1 ? 'row-cols-3' : '' ?> gy-2">
                    <?php

                    while ($attachment = $get_attachments->fetch_assoc()) {
                    ?>
                        <div class="col">
                            <img src="<?php echo $attachment['photo'] ?>" class="img-fluid img-thumbnail" alt="">
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <p class="mb-0 py-0 text-start">
                    <span><?php echo $row['message'] ?></span>
                </p>
            </div>
            <p class="mt-1 mb-0 date text-secondary fw-light">
                <small>
                    <?php echo date("M d, Y", strtotime($row['created_at'])) ?>
                </small>
                <?php
                if ($i == $num_of_messages && $row['is_admin'] == '0') {
                ?>
                    <?php
                    if ($row['status'] == 0) {
                    ?>
                        <small class="ms-2">
                            <i class="bx bx-check-circle fs-6"></i>
                        </small>

                    <?php
                    } else if ($row['status'] == 1) {
                    ?>
                        <br>
                        <small class="ms-2">
                            Delivered <i class="bx bxs-check-circle"></i>
                        </small>
                    <?php
                    } else {
                    ?>
                        <br>
                        <small>
                            Seen
                        </small>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </p>
        </div>
<?php
    }
    $i++;
}

if($query->num_rows == 0){
    ?>
    <p class="text-center">No messages to show.</p>
    <?php
}
?>