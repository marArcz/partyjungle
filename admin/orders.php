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
        $active_page = "orders";
        include './includes/sidebar.php'
        ?>
        <main class="main-container">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="card rounded-4 border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-end mb-4">
                                <span class="card-icon card-icon-sm me-2 shadow-sm">
                                    <i class="bx bxs-time bx-sm"></i>
                                </span>
                                <p class="fs-4 fw-bold my-0"> Orders</p>
                            </div>
                            <table class="table" id="table">
                                <thead>
                                    <th>Transaction No.</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Payment Method</th>
                                    <th>Shipping</th>
                                    <th>Status</th>
                                </thead>
                            </table>
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