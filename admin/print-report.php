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
    <style>
        #print-section {}
    </style>
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
                                <li class="nav-item">
                                    <a href="reports.php" class="nav-link">
                                        <i class='bx bx-bar-chart-square fs-4 link-dark'></i>
                                    </a>
                                </li>

                                <li class="nav-item active">
                                    <a href="print-report.php" class="nav-link">
                                        <i class='bx bx-printer fs-4 link-dark'></i>
                                    </a>
                                </li>
                            </ul>
                            <div class="text-start mb-4">
                                <button class="btn btn-orange btn-sm text-light" type="button" id="print-btn">
                                    Print <i class="bx bx-printer text-light"></i>
                                </button>
                            </div>
                            <div class="w-100 overflow-auto">
                                <div id="print-section" class="">
                                    <div class="container p-4 position-relative">
                                        <div class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <img src="../assets/images/ban_img1.png" width="80px" alt="" class=" start-0">

                                                <div class="ms-auto me-auto">
                                                    <p class="my-1 fs-5">
                                                        Party Jungle Needs & Toys
                                                    </p>
                                                    <p class="my-1">
                                                        <i>2nd floor illustre avenue, Brgy Palanas, Lemery Batangas</i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <p class="fs-6 my-1">System Report</p>
                                            <p class="fs-6 my-1">Data</p>
                                        </div>
                                        <div class="mt-2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <th>Month</th>
                                                    <th>Sales</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $year = date('Y');
                                                    for ($month = 0; $month <= 12; $month++) {
                                                        $query = mysqli_query($con, "SELECT SUM(price) FROM order_details WHERE order_id IN (SELECT id FROM orders WHERE MONTH(ordered_at) = $month AND YEAR(ordered_at) = $year AND status IN (SELECT status_code FROM order_status WHERE status_label = 'Delivered'))");
                                                        $sales = $query->fetch_array()[0];
                                                    ?>
                                                        <tr>
                                                            <td><?php echo date('F', strtotime("2023-$month-01")) ?></td>
                                                            <td><?php echo $sales ? '₱ ' . $sales : '' ?></td>
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
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/scripts.php' ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $("#print-btn").on("click", function(e) {
            var opt = {
                margin: 1,
                filename: 'myfile.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };
            var worker = html2pdf().set(opt).from($("#print-section")[0]).toPdf().get('pdf').then(function(pdfObj) {
                // pdfObj has your jsPDF object in it, use it as you please!
                // For instance (untested):
                pdfObj.autoPrint();
                url = pdfObj.output('bloburl')
                window.open(url, "_blank")
            });
        })

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