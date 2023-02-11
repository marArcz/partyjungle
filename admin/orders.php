<?php include '../conn/conn.php' ?>
<?php include './includes/OrderStatus.php' ?>
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
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-time bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Orders</p>
                    </div>
                    <div class="card rounded-4 border-0">
                        <div class="card-body py-4">
                            <?php
                            $status = isset($_GET['status']) ? $_GET['status'] : OrderStatus::$ORDER_PLACED;
                            ?>
                            <div class="text-start">
                                <a href="#status-modal" data-bs-toggle="modal" class="link-secondary fw-bold text-decoration-none">
                                    <i class="bx bx-chevron-down"></i>
                                    <?php echo OrderStatus::getStringStatus($status) ?>
                                    <i class="bx bx-filter"></i>
                                </a>
                            </div>
                            <div class="alert alert-info mb-4 mt-2 py-2">
                                <small>Showing orders with status of <strong><?php echo OrderStatus::getStringStatus($status) ?></strong>.</small>
                            </div>
                            <table class="table" id="table">
                                <thead>
                                    <th>Transaction No.</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Payment Method</th>
                                    <th>Shipping</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    //get orders
                                    $query = mysqli_query($con, "SELECT * FROM orders WHERE status = $status");
                                    while ($row = $query->fetch_assoc()) {
                                        //get number of items in the order
                                        $getItems = mysqli_query($con, "SELECT * FROM order_details WHERE order_id=" . $row['id']);
                                        $itemCount = $getItems->num_rows;
                                    ?>
                                        <tr>
                                            <td><?php echo $row['transaction_no'] ?></td>
                                            <td><?php echo $row['customer'] ?></td>
                                            <td><?php echo $itemCount ?></td>
                                            <td><?php echo $row['payment_method'] ?></td>
                                            <td><?php echo $row['shipping_type'] ?></td>
                                            <td><?php echo $row['status'] ?></td>
                                            <td>
                                                <a href="#manage-modal" class="link-secondary">
                                                    <i class="bx bx-eye"></i>
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
    <?php include './includes/modals/orders-modals.php' ?>
    <?php include './includes/scripts.php' ?>
    <script>

    </script>
</body>

</html>