<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "services";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-wrench bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Services</p>
                    </div>
                    <div class="text-end mb-3">
                        <a href="add-service-page.php" class="btn btn-orange">Add Service</a>
                    </div>
                    <div class="card border-0 rounded-4 shadow-sm">
                        <div class="card-body">
                            <table class="table align-middle" id="table">
                                <thead>
                                    <th>Photo</th>
                                    <th>Service </th>
                                    <th>Description</th>
                                    <th>Service Options</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM services");
                                    while ($row = $query->fetch_assoc()) {
                                        $service_id = $row['id'];
                                        $options_count = mysqli_query($con, "SELECT id FROM service_options WHERE service_id=$service_id")->num_rows;
                                    ?>
                                        <tr>
                                            <td>
                                                <img src="../<?php echo $row['photo'] ?>" class="img-fluid" width="50px" alt="">
                                            </td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td><?php echo $options_count ?></td>
                                            <td>
                                                <a href="manage-service.php?service_id=<?php echo $service_id ?>" class="btn btn-brown btn-sm link-light rounded-3 ">
                                                    <i class="bx bxs-show"></i>
                                                </a>
                                                <a href="delete-service.php?id=<?php echo $service_id ?>" class="delete-service btn btn-danger btn-sm link-light rounded-3 ">
                                                    <i class="bx bxs-trash"></i>
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
            </section>
        </main>
    </div>

    <?php include './includes/scripts.php' ?>
    <?php include './includes/alerts.php' ?>

    <script>
        $(".delete-service").on("click", function(e) {
             e.preventDefault();
             let url = $(this).attr('href');

             Notiflix.Confirm.show(
                'Confirm Action',
                'Delete Service Option?',
                'Yes',
                'No',
                function okCb() {
                    window.location.href = url;
                },
                function cancelCb() {}, {},
            );
        })
    </script>
</body>

</html>