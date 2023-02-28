<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
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
        $active_page = "reservations";
        include './includes/sidebar.php';
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-book bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Service Reservations</p>
                    </div>
                    <?php
                    $status = isset($_GET['status']) ? $_GET['status'] : "All";
                    ?>
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body">
                            <ul class="nav mb-4 custom-nav">
                                <li class="nav-item me-3 <?php echo $status == "All" ? 'active' : '' ?>">
                                    <a href="service-reservations.php?status=All" class="nav-link link-dark fw-light">
                                        <?php

                                        // get number of reservations
                                        $count = mysqli_query($con, "SELECT COUNT(id) FROM service_reservations")->fetch_array()[0];
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
                                    $count = mysqli_query($con, "SELECT count(id) FROM service_reservations WHERE status =" . $row['status_code'])->fetch_array()[0];
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
                            <div class="table-responsive-md mt-2">
                                <table class="table align-middle" id="table">
                                    <thead>
                                        <th>Customer</th>
                                        <th>Service</th>
                                        <th>Option</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($status != "All") {
                                            $query = mysqli_query($con, "SELECT service_reservations.*, reservation_status.status_code,reservation_status.status_label FROM service_reservations INNER JOIN reservation_status ON service_reservations.status = reservation_status.status_code WHERE status IN (SELECT status_code FROM reservation_status WHERE status_label = '$status')");
                                        } else {
                                            $query = mysqli_query($con, "SELECT service_reservations.*, reservation_status.status_code,reservation_status.status_label FROM service_reservations INNER JOIN reservation_status ON service_reservations.status = reservation_status.status_code");
                                        }
                                        while ($row = $query->fetch_assoc()) {
                                            $option = mysqli_query($con, "SELECT * FROM service_options WHERE id = " . $row['service_option_id'])->fetch_assoc();
                                            $service = mysqli_query($con, "SELECT * FROM services WHERE id = " . $row['service_id'])->fetch_assoc();
                                            $user = mysqli_query($con, "SELECT * FROM users WHERE id = " . $row['user_id'])->fetch_assoc();
                                        ?>
                                            <tr>
                                                <td><?php echo $user['firstname'] . ' ' . $user['lastname'] ?></td>
                                                <td><?php echo $service['name'] ?></td>
                                                <td><?php echo $option['label'] ?></td>
                                                <td><?php echo $option['price'] ?></td>
                                                <td><?php echo date("M d, Y", strtotime($row['date'])) ?></td>
                                                <td><?php echo date("h:i a", strtotime($row['time'])) ?></td>
                                                <td><?php echo $row['status_label'] ?></td>

                                                <td>
                                                    <a href="#details-modal" data-bs-toggle="modal" class="btn btn-sm btn-brown">
                                                        <i class="bx bxs-show text-light"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <?php include './includes/modals/reservation-modals.php' ?>
    <?php include './includes/scripts.php' ?>
    <script>

    </script>
</body>

</html>