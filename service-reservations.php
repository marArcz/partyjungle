<?php include './conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<?php include './includes/verifyUserSession.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Jungle Toys & Party Needs</title>
    <?php $active_page = "reservations" ?>
    <?php include './includes/header.php' ?>
</head>

<body class="">
    <?php include './includes/top_header.php' ?>
    <?php
    $user_id = Session::getUser()['id'];

    $status = !isset($_GET['status']) ? "All" : $_GET['status'];

    $query = mysqli_query($con, "SELECT * FROM categories LIMIT 1");
    $category_row = $query->fetch_assoc();
    $category = isset($_GET['category']) ? $_GET['category'] : "all";
    ?>
    <main class="main">
        <section>
            <div class="container my-5">

                <h4 class="text-dark fw-light">Service Reservations</h4>
                <hr>
                <ul class="nav mb-4 custom-nav">
                    <li class="nav-item me-3 <?php echo $status == "All" ? 'active' : '' ?>">
                        <a href="service-reservations.php?status=All" class="nav-link link-dark fw-light">
                            <?php
                            // get number of reservations
                            $count = mysqli_query($con, "SELECT COUNT(id) FROM service_reservations WHERE user_id = $user_id")->fetch_array()[0];
                            ?>
                            <span>All</span>
                            <?php
                            if ($count > 0) {
                            ?>
                                <span class="text-bg-light badge border text-orange"><?php echo $count ?></span>
                            <?php
                            }
                            ?>

                        </a>
                    </li>
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM reservation_status");
                    while ($row = $query->fetch_assoc()) {
                        $count = mysqli_query($con, "SELECT count(id) FROM service_reservations WHERE user_id = $user_id AND status =" . $row['status_code'])->fetch_array()[0];
                    ?>
                        <li class="nav-item me-3 <?php echo $status == $row['status_label'] ? 'active' : '' ?>">
                            <a href="service-reservations.php?status=<?php echo $row['status_label'] ?>" class="nav-link link-dark fw-light ">
                                <?php echo $row['status_label'] ?>
                                <?php
                                if ($count > 0) {
                                ?>
                                    <span class="text-bg-light badge border text-orange"><?php echo $count ?></span>
                                <?php
                                }
                                ?>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <?php
                if ($status != "All") {
                ?>
                    <div class="alert alert-brown py-2">
                        <i class="bx bx-info-circle"></i> <small><?php echo $status ?> Reservations</small>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($status != "All") {
                    $query = mysqli_query($con, "SELECT service_reservations.*, reservation_status.status_code,reservation_status.status_label FROM service_reservations INNER JOIN reservation_status ON service_reservations.status = reservation_status.status_code WHERE user_id = $user_id AND status IN (SELECT status_code FROM reservation_status WHERE status_label = '$status')");
                } else {
                    $query = mysqli_query($con, "SELECT service_reservations.*, reservation_status.status_code,reservation_status.status_label FROM service_reservations INNER JOIN reservation_status ON service_reservations.status = reservation_status.status_code WHERE user_id = $user_id ");
                }
                while ($row = $query->fetch_assoc()) {
                    $option = mysqli_query($con, "SELECT * FROM service_options WHERE id = " . $row['service_option_id'])->fetch_assoc();
                    $service = mysqli_query($con, "SELECT * FROM services WHERE id = " . $row['service_id'])->fetch_assoc();
                ?>

                    <div class="card border-0 shadow rounded-1 mb-3">
                        <div class="card-body p-4">
                            <p class="text-secondary my-1">
                                <small class="">Status: <span class="text-<?php echo $row['status_label'] == 'Cancelled' ? 'dark' : 'success' ?>"><?php echo $row['status_label'] ?></span></small>
                            </p>
                            <div class="mt-4">
                                <div class="row mt-2 mb-3">
                                    <div class="col-md-4">
                                        <p class="text-secondary fs-5"><?php echo $service['name'] ?></p>
                                        <p class="my-1"><?php echo $option['label'] ?> - <span class="text-orange">₱<?php echo $option['price'] ?></span></p>
                                    </div>
                                    <div class="col-md">
                                        <div class="d-flex flex-wrap">
                                            <p class="me-3"><i class="bx bx-calendar bx-lg"></i></p>
                                            <div>
                                                <p class="my-1"><span class=" text-secondary fw-light">Date:</span> <?php echo $row['date'] ?></p>
                                                <p class="my-1"><span class=" text-secondary fw-light">Time:</span> <?php echo date('h:i a', strtotime($row['time'])) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <!-- <a href="#details-modal" data-bs-toggle="modal" data-id="<?php echo $row['id'] ?>" class="btn btn-orange btn-sm me-1">
                                    <i class="bx bx-info-circle"></i> Details
                                </a> -->
                                <?php
                                if ($row['status'] == 0) {
                                ?>
                                    <a href="cancel-reservation.php?id=<?php echo $row['id'] ?>&status=<?php echo $status ?>" class="btn btn-light border btn-sm">
                                        Cancel
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="#details-modal" data-bs-toggle="modal" data-="" class="btn btn-light text-danger border btn-sm">
                                        Delete
                                    </a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($query->num_rows == 0) {
                ?>
                    <p class="text-center">Nothing to show.</p>
                <?php
                }
                ?>
            </div>
        </section>
        <?php
        include './includes/featured-products.php';
        ?>
    </main>
    <?php include './includes/chat.php' ?>
    <?php include './includes/footer.php' ?>
    <?php include './includes/reservation-modal.php' ?>
    <?php include './includes/scripts.php' ?>
</body>

</html>