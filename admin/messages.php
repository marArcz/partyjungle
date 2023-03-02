<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<?php include './includes/MessageTypes.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "messages";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-message bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Messages</p>
                    </div>
                    <div class="card rounded-4 border-0 shadow-sm p-3">
                        <div class="card-body">
                            <p class="card-text my-1">
                                Conversations
                            </p>
                            <hr>
                            <ul class="list-group list-group-flush conversations-list">
                                <?php
                                // get all conversatations
                                $query = mysqli_query($con, "SELECT * FROM conversations");
                                while ($row = $query->fetch_assoc()) {
                                    $user = mysqli_query($con, "SELECT * FROM users WHERE id=" . $row['user_id'])->fetch_assoc();
                                    $conversation_id = $row['id'];
                                    $get_chat = mysqli_query($con, "SELECT * FROM chat WHERE conversation_id = $conversation_id ORDER BY id DESC LIMIT 1");
                                    if ($get_chat->num_rows > 0) {
                                        $chat = $get_chat->fetch_assoc();
                                    }
                                ?>
                                    <li class="list-group-item <?php echo $chat['status'] == 0 ? 'bg-light' : '' ?>">
                                        <a href="chats.php?conversation_id=<?php echo $conversation_id ?>" class=" text-decoration-none">
                                            <div class="row">
                                                <div class="col-auto">

                                                    <?php
                                                    if (empty($user['photo'])) {
                                                    ?>
                                                        <div class="conversation-text-photo">
                                                            <span><?php echo $user['firstname'][0] . $user['lastname'][0] ?></span>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="conversation-photo" data-img="../<?php echo $user['photo'] ?>">
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col">
                                                    <p class="my-1 fw-bold text-<?php echo $chat['status'] == 0 ? 'dark ' : 'secondary' ?>">
                                                        <span><?php echo $user['firstname'] . " " . $user['lastname'] ?></span>
                                                    </p>
                                                    <p class="my-1 col-12 col-lg-7 text-truncate text-<?php echo $chat['status'] == 0 ? 'dark fw-bold' : 'secondary' ?>">
                                                        <small>
                                                            <?php
                                                            if ($get_chat->num_rows > 0) {
                                                                if (empty($chat['message'])) {
                                                                    if ($chat['type'] != MessageTypes::$PRODUCTS) {
                                                            ?>
                                                                        <span>
                                                                            <?php echo $user['firstname'] . " " . $user['lastname'] . " sent image."; ?>
                                                                        </span>
                                                                    <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <span><?php echo $chat['message'] ?></span>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>

                            <?php
                            if ($query->num_rows == 0) {
                            ?>
                                <p class="my-0 text-center text-secondary">No messages to show</p>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/scripts.php' ?>
    <script>
        $(function() {
            $(".conversation-photo").each((index, elem) => {
                let img = $(elem).data('img')
                $(elem).css("background-image", `url(${img})`)
            })
        })
    </script>
</body>

</html>