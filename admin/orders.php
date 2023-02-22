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
                            <!-- <div class="alert alert-info mb-4 mt-2 py-2">
                                <small>Showing orders with status of <strong><?php echo OrderStatus::getStringStatus($status) ?></strong>.</small>
                            </div> -->
                            <div class="table-responsive-sm">
                                <table class="table align-items-center" id="table">
                                    <thead>
                                        <th class="text-secondary">
                                            <small>Order ID</small>
                                        </th>
                                        <th class="text-secondary"><small>Customer</small></th>
                                        <th class="text-secondary"><small>Items</small></th>
                                        <th class="text-secondary"><small>Payment Method</small></th>
                                        <th class="text-secondary"><small>Shipping</small></th>
                                        <th class="text-secondary"><small>Status</small></th>
                                        <th class="text-secondary"><small>Action</small></th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        //get orders
                                        $query = mysqli_query($con, "SELECT orders.*, CONCAT(users.firstname,' ',users.lastname) AS customer FROM orders INNER JOIN users ON orders.user_id = users.id WHERE orders.status = $status");
                                        while ($row = $query->fetch_assoc()) {
                                            //get number of items in the order
                                            $getItems = mysqli_query($con, "SELECT * FROM order_details WHERE order_id=" . $row['id']);
                                            $itemCount = $getItems->num_rows;
                                            $status_row = mysqli_query($con, "SELECT * FROM order_status WHERE status_code = " . $row['status'])->fetch_assoc();
                                            $shipping_row = mysqli_query($con, "SELECT * FROM shipping WHERE id = " . $row['shipping_id'])->fetch_assoc();
                                        ?>
                                            <tr class="shadow-sm">
                                                <td class="py-3 text-dark fw-bold">
                                                    <small>#<?php echo $row['transaction_no'] ?></small>
                                                </td>
                                                <td class="py-3">
                                                    <small><?php echo $row['customer'] ?></small>
                                                </td>
                                                <td class="py-3">
                                                    <small><?php echo $itemCount ?></small>
                                                </td>
                                                <td class="py-3">
                                                    <small><?php echo $row['payment_method'] ?></small>
                                                </td>
                                                <td class="py-3">
                                                    <small><?php echo $shipping_row['description'] ?></small>
                                                </td>
                                                <td class="py-3 text-primary">
                                                    <small><?php echo $status_row['status_label'] ?></small>
                                                </td>
                                                <td class="py-3">
                                                    <a href="manage-order.php?transaction_no=<?php echo $row['transaction_no'] ?>" class="btn btn-sm btn-brown text-light rounded-3 ">
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
    <?php include './includes/modals/orders-modals.php' ?>
    <?php include './includes/scripts.php' ?>
    <script>
        $(".collapse-toggler").on("click", function(e) {
            var expanded = $(this).attr("aria-expanded");
            console.log('expanded: ', expanded)
            if (expanded) {
                $(this).find('i').removeClass("bx-chevron-down").addClass("bx-chevron-up");
            } else {
                $(this).find('i').removeClass("bx-chevron-up").addClass("bx-chevron-down");
            }
        })
    </script>
</body>

</html>