<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "users";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <a href="users.php" class=" text-decoration-none">
                            <span class="card-icon card-icon-sm me-2 shadow-sm">
                                <i class="bx bx-arrow-back bx-sm"></i>
                            </span>
                        </a>
                        <p class="fs-4 fw-bold my-0"> User Info</p>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body py-4">

                            <?php
                            $user_id = $_GET['id'];
                            $user = mysqli_query($con, "SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
                            ?>
                            <p class=" shadow-sm text-bg-light badge rounded-pill py-2 px-3 fw-bold text-dark">
                                Information
                            </p>
                            <div class="row align-items-">
                                <div class="col-md-auto">
                                    <div class="div-image rounded-circle" data-image="../<?php echo $user['photo'] ?>"></div>
                                </div>
                                <div class="col-md">
                                    <div class="row align-items-center">
                                        <div class="col-md">
                                            <p class=" fw-bold"><?php echo $user['firstname'] ?> <?php echo $user['lastname'] ?></p>
                                            <div class="row">
                                                <div class="col-md">
                                                    <p class="m">Username: <?php echo $user['username'] ?></p>
                                                </div>
                                                <div class="col-md">
                                                    <p class="m">Address: <?php echo $user['address'] ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md">
                                                    <p class="">Phone: <?php echo $user['contact'] ?></p>
                                                </div>
                                                <div class="col-md">
                                                    <p class="">Email: <?php echo $user['email'] ?></p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-auto text-end">
                                            <a href="open-chat.php?user_id=<?php echo $user['id'] ?>" class="link-orange me-2">
                                                <i class="bx bx-chat fs-4"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->
                    <div class="card border-0 shadow-sm mt-3">
                        <div class="card-body py-4">
                            <p class=" shadow-sm text-bg-light badge rounded-pill mb-0 py-2 px-3 fw-bold text-dark">
                                Order Records
                            </p>
                            <?php
                            $ongoing_orders = mysqli_query($con, "SELECT COUNT(id) FROM orders WHERE user_id = $user_id AND status IN (SELECT status_code FROM order_status WHERE status_label!='Cancelled' AND status_label!='Delivered')")->fetch_array()[0];
                            $completed_orders = mysqli_query($con, "SELECT COUNT(id) FROM orders WHERE user_id = $user_id AND status IN (SELECT status_code FROM order_status WHERE status_label = 'Delivered')")->fetch_array()[0];
                            ?>
                            <div class="container-fluid">
                                <hr>
                                <div class="row">
                                    <div class="col-md-auto text-center">
                                        <div class="card border rounded-0">
                                            <div class="card-body">
                                                <p class="text-orange fw-bold my-1">
                                                    <?php echo $ongoing_orders ?>
                                                </p>
                                                <p class="fw-bold form-text mb-0"><small>Ongoing Orders</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto text-center">
                                        <div class="card border rounded-0">
                                            <div class="card-body">
                                                <p class="text-orange fw-bold my-1">
                                                    <?php echo $completed_orders ?>
                                                </p>
                                                <p class="fw-bold form-text mb-0"><small>Completed Orders</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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