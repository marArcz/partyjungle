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
        $active_page = "users";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-user bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Users</p>
                    </div>
                    <div class="card shadow-sm border-0 rounded-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle" id="table">
                                    <thead>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM users");
                                        while ($row = $query->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php
                                                    if (!empty($row['photo'])) {
                                                    ?>
                                                        <div class="div-image border shadow-sm border-3 view-photo rounded-circle div-image-sm" data-image="<?php echo "../" . $row['photo'] ?>"></div>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="user-text-photo">
                                                            <span><?php echo $row['firstname'][0] . $row['lastname'][0] ?></span>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['firstname'] . " " . $row['lastname'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['email'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['contact'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['address'] ?>
                                                </td>
                                                <td>
                                                    <a href="view-user.php?id=<?php echo $row['id'] ?>" class="btn btn-sm btn-brown text-light rounded-3">
                                                        <i class="bx bxs-show"></i>
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
    <?php include './includes/modals/photo-modal.php' ?>
    <?php include './includes/scripts.php' ?>
    <script>

    </script>
</body>

</html>