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
        include './includes/sidebar.php'
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
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive-md">
                                <table class="table align-middle" id="table">
                                    <thead>
                                        <th>Customer</th>
                                        <th>Service</th>
                                        <th>Option</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>time</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM service_reservations");
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
                                                <td>
                                                    <a href="#manage-modal" data-bs-toggle="modal" class="btn btn-sm btn-brown">
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

    <?php include './includes/scripts.php' ?>
    <script>

    </script>
</body>

</html>