<?php include '../conn/conn.php' ?>
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
        <main class="main-container">
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
                            <ul class="list-group list-group-flush">
                                <?php
                                // get all conversatations
                                $query = mysqli_query($con, "SELECT * FROM conversations");
                                while ($row = $query->fetch_assoc()) {
                                    $user = mysqli_query($con,"SELECT * FROM users WHERE id=" . $row['user_id']);
                                ?>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="conversation-photo">
                                                <span><?php echo $user['firstname'][0] . $user['lastname'][0] ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/scripts.php' ?>
    <script>

    </script>
</body>

</html>