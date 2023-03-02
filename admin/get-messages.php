<?php
include '../conn/conn.php';
include './includes/MessageTypes.php';

$conversation_id = $_POST['conversation_id'];
$conversation = mysqli_query($con, "SELECT conversations.*, users.firstname,users.lastname,users.photo FROM conversations INNER JOIN users ON conversations.user_id = users.id WHERE conversations.id = $conversation_id")->fetch_assoc();

$query = mysqli_query($con, "SELECT * FROM chat WHERE conversation_id = $conversation_id ORDER BY id ASC");
$update_chat_status = mysqli_query($con, "UPDATE chat SET status = 2 WHERE is_admin =0 AND conversation_id = $conversation_id");
$num_of_messages = $query->num_rows;
$i = 1;
while ($row = $query->fetch_assoc()) {
    if ($row['is_admin'] == 0 && $row['type'] == MessageTypes::$PLAIN_MESSAGE) {
        $user = mysqli_query($con, "SELECT * FROM users WHERE id = " . $row['user_id'])->fetch_assoc();
?>
        <div class="chat-item ">
            <div class="chat-sender">
                <div class="conversation-photo" style="width:30px;height:30px;" data-img="../<?php echo $conversation['photo'] ?>">
                </div>
            </div>
            <div class="chat-content bg-light text-dark border shadow-sm">
                <?php echo $row['message'] ?>
            </div>
            <p class="my-1 date text-secondary fw-light"><small><?php echo date('M d, Y') ?></small></p>
        </div>
    <?php
    } else if ($row['is_admin'] == 0 && ($row['type'] == MessageTypes::$MESSAGE_WITH_ATTACHMENTS || $row['type'] == MessageTypes::$ATTACHMENTS)) {
    ?>
        <div class="chat-item ">
            <div class="chat-sender">
                <div class="conversation-photo" style="width:30px;height:30px;" data-img="../<?php echo $conversation['photo'] ?>">
                </div>
            </div>
            <div class="chat-content bg-light text-dark border shadow-sm">
                <div class="attachment-row">
                    <div class="d-flex flex-wrap">
                        <?php
                        $chat_id = $row['id'];
                        $get_attachments = mysqli_query($con, "SELECT id,photo FROM chat_attachments WHERE chat_id = $chat_id");
                        while ($attachment = $get_attachments->fetch_assoc()) {
                        ?>
                            <div class="">
                                <img src="../<?php echo $attachment['photo'] ?>" class="img-thumbnail me-2 view-photo" alt="">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
                if (!empty($row['message'])) {
                ?>
                    <p class="mb-0 mt-3">
                        <?php echo $row['message'] ?>
                    </p>
                <?php
                }
                ?>
            </div>
            <p class="my-1 date text-secondary fw-light"><small>Feb 24, 2023</small></p>
        </div>
    <?php
    } else if ($row['is_admin'] == 1 && $row['type'] == MessageTypes::$PLAIN_MESSAGE) {
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
                if ($i == $num_of_messages && $row['is_admin'] == 1) {
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
                    }else{
                        ?>
                        <br>
                        <small>Seen</small>
                        <?php
                    }
                    ?>
                <?php
                }
                ?>
            </p>

        </div>
    <?php
    } else if ($row['is_admin'] == 1 && ($row['type'] == MessageTypes::$MESSAGE_WITH_ATTACHMENTS || $row['type'] == MessageTypes::$ATTACHMENTS)) {
        $chat_id = $row['id'];
        $get_attachments = mysqli_query($con, "SELECT id,photo FROM chat_attachments WHERE chat_id = $chat_id");
    ?>
        <div class="chat-item owned">
            <div class="chat-content bg-light text-dark border shadow-sm">
                <div class="attachment-row mb-2">
                    <div class="d-flex flex-wrap">
                        <?php
                        $chat_id = $row['id'];
                        $get_attachments = mysqli_query($con, "SELECT id,photo FROM chat_attachments WHERE chat_id = $chat_id");
                        while ($attachment = $get_attachments->fetch_assoc()) {
                        ?>
                            <div class="">
                                <img src="../<?php echo $attachment['photo'] ?>" class="img-thumbnail me-2 view-photo" alt="">
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <p class="mb-0 py-0 text-end">
                    <span><?php echo $row['message'] ?></span>
                </p>
            </div>
            <p class="mt-1 mb-0 date text-secondary fw-light">
                <small>
                    <?php echo date("M d, Y", strtotime($row['created_at'])) ?>
                </small>
                <?php
                if ($i == $num_of_messages && $row['is_admin'] == 1) {
                ?>
                    <?php
                    if ($row['status'] == 0) {
                    ?>
                        <small class="ms-2">
                            Sent <i class="bx bx-check-circle fs-6"></i>
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
                        <small class="ms-2">
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