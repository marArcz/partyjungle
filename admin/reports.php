<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "reports";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-folder bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Reports</p>
                    </div>

                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <!-- nav -->
                            <ul class="nav custom-nav mb-3 justify-content-end">
                                <li class="nav-item active">
                                    <a href="" class="nav-link">
                                        <i class='bx bx-bar-chart-square fs-4 link-dark'></i>
                                    </a>
                                </li>
                             
                                <li class="nav-item">
                                    <a href="print-report.php" class="nav-link">
                                        <i class='bx bx-printer fs-4 link-dark'></i>
                                    </a>
                                </li>
                            </ul>
                            <p class="fs-6">Sales of Year <?php echo date('Y') ?></p>
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
        function loadChart(data) {
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Sales',
                        data: data,
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
            $.ajax({
                url: "get-sales.php",
                method: "post",
                dataType: "json",
                success: res => {
                    console.log('res: ', res)
                    loadChart(res.sales)
                }

            })
        })
    </script>
</body>

</html>