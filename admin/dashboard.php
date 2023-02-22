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
        $active_page = "dashboard";
        include './includes/sidebar.php'
        ?>
        <main class="main-container">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <!-- <p class="fs-4 fw-bold">Dashboard</p> -->
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon d-none d-lg-block card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-tachometer bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0">Dashboard</p>
                    </div>
                    <div class="row mt-3 gx-3 gy-3">
                        <div class="col-md-3">
                            <div class="card rounded-4 border-0">
                                <div class="card-body py-4 px-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="card-icon ">
                                                <i class="bx bx-sm bxs-group"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <?php
                                            // get number of customers
                                            $query = mysqli_query($con, "SELECT * FROM users");
                                            $num_of_customers = $query->num_rows;
                                            ?>
                                            <p class="my-1 fw-bold fs-5"><?php echo $num_of_customers ?></p>
                                            <p class="my-1 text-secondary">
                                                <small>Customers</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card rounded-4 border-0">
                                <div class="card-body py-4 px-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="card-icon">
                                                <i class='bx bx-sm bxs-package'></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p class="my-1 fw-bold fs-5">5</p>
                                            <p class="my-1 text-secondary">
                                                <small>Products</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card rounded-4 border-0">
                                <div class="card-body py-4 px-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="card-icon">
                                                <i class='bx bx-sm bxs-truck'></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p class="my-1 fw-bold fs-5">5</p>
                                            <p class="my-1 text-secondary">
                                                <small>Total Deliveries</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card rounded-4 border-0">
                                <div class="card-body py-4 px-3">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="card-icon">
                                                <i class='bx bx-line-chart bx-sm'></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <p class="my-1 fw-bold fs-5">P 0</p>
                                            <p class="my-1 text-secondary">
                                                <small>Total Sales</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card rounded-4 border-0 mt-3">
                        <div class="card-body">
                            <p class="fs-6">Orders of Year <?php echo date('Y') ?></p>
                            <div class="mt-3">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/scripts.php' ?>
    <script>
        function loadChart() {
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: 'Orders count',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1,
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        $(function() {
            loadChart();
        })
    </script>
</body>

</html>