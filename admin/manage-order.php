<?php include '../conn/conn.php' ?>
<?php include './includes/OrderStatus.php' ?>
<?php include_once './includes/Session.php' ?>
<?php
if (!isset($_GET['transaction_no'])) {
    Session::redirectTo("orders.php");
    exit();
}

// get order info
$transaction_no = $_GET['transaction_no'];
$query = mysqli_query($con, "SELECT orders.*, shipping.description,shipping.price FROM orders INNER JOIN shipping ON orders.shipping_id = shipping.id WHERE orders.transaction_no = '$transaction_no'");
//if not found
if ($query->num_rows == 0) {
    Session::redirectTo("orders.php");
    exit();
} else {
    $order = $query->fetch_assoc();
}
?>
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
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state")? (Session::getSession("partyjungle-sidebar-state",false) == "close"? 'sidebar-closed':''):'' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <a href="orders.php?status=<?php echo $_GET['status'] ?>" class="card-icon link-light text-decoration-none card-icon-sm me-2 shadow-sm">
                            <i class="bx bx-arrow-back bx-sm"></i>
                        </a>
                        <p class="fs-4 fw-bold my-0"> Manage Order</p>
                    </div>
                    <?php
                    // get order details
                    $order_id = $order['id'];
                    $transaction_no = $order['transaction_no'];
                    $description = $order['description'];
                    $total = $order['total'];
                    $status =  $order['status'];

                    $subtotal = 0;

                    //get order details 2 products only
                    $get_details = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id");
                    $num_of_products = mysqli_query($con, "SELECT COUNT(*) FROM order_details WHERE order_id = $order_id")->fetch_array()[0];

                    ?>
                    <div class="row gy-3">
                        <div class="col-md">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body py-4">
                                    <p class=" shadow-sm text-bg-light badge rounded-pill py-2 px-3 fw-bold text-secondary">
                                        Order
                                        <span class="text-brown">#</span>
                                        <span class=" fw-bold text-dark"><?php echo $order['transaction_no'] ?></span>
                                    </p>

                                    <div class="px-3 d-flex align-items-center">
                                        <?php $status = mysqli_query($con, "SELECT * FROM order_status WHERE status_code=" . $order['status'])->fetch_assoc(); ?>
                                        <div>
                                            <p class="my-1 text-secondary fw-light">Status</p>
                                            <p class="my-1 text-dark fw-bold"><?php echo $status['status_label'] ?></p>
                                        </div>
                                        <div class="ms-auto">
                                            <p class="my-1 text-dark">
                                                <?php echo $num_of_products ?> items
                                            </p>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        while ($details = $get_details->fetch_assoc()) :
                                            $subtotal += $details['price'] * $details['quantity'];
                                        ?>
                                            <li class="list-group-item">
                                                <div class="row mt-3 align-items-center">
                                                    <div class="col-sm-5 col-6 col-md-3 col-lg-3">
                                                        <img src="../<?php echo $details['product_photo'] ?>" alt="" class="img-fluid img-thumbnail">
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col-md">
                                                                <p class="my-1 fw-bold"><?php echo $details['product_name'] ?></p>
                                                                <div class="text-secondary">
                                                                    <p>Qty: <?php echo $details['quantity'] ?></p>

                                                                </div>
                                                            </div>
                                                            <div class="col-md">
                                                                <p class="text-orange my-1"><strong>₱</strong> <?php echo $details['price'] * $details['quantity'] ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        <?php
                                        endwhile;
                                        ?>
                                    </ul>
                                    <div class="px-4">
                                        <hr>
                                        <div class="row  mt-3">
                                            <div class="col-md">
                                                <div class="">
                                                    <?php
                                                    $shipping = mysqli_query($con, "SELECT * FROM shipping WHERE id = " . $order['shipping_id'])->fetch_assoc();
                                                    ?>
                                                    <p class="text-secondary fw-light">Shipping Type:</p>
                                                    <p class="my-1">
                                                        <?php echo $shipping['description'] ?>
                                                        <i class="bx bxs-truck bx-flip-horizontal text-orange"></i>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="my-1 text-secondary fw-light">Subtotal</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="my-1"><strong>₱</strong> <?php echo $subtotal ?></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="my-1 text-secondary fw-light">Shipping fee</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="my-1"><strong>₱</strong> <?php echo $shipping['price'] ?></p>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col">
                                                        <p class="my-1 text-secondary fw-light">Total</p>
                                                    </div>
                                                    <div class="col">
                                                        <p class="my-1 text-orange"><strong>₱</strong> <?php echo $total + $shipping['price'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-4 mb-1 text-end text-black-50">
                                        <small>
                                            Order was placed on
                                            <?php echo date("M d, Y", strtotime($order['ordered_at'])) ?>
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body py-4">
                                    <p class="p-3 text-bg-light badge shadow-sm">Status</p>
                                    <ul class="status-list">

                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM order_status WHERE status_code != -1 AND status_code != 5 ORDER BY id ASC");
                                        while ($status = $query->fetch_assoc()) {
                                        ?>
                                            <li class="<?php echo $order['status'] + 1 == $status['status_code'] ? 'enabled' : '' ?> <?php echo $order['status'] == $status['status_code'] ? ($order['status'] == 4?'checked':'active') : ($order['status'] > $status['status_code'] ? 'checked' : '') ?>">
                                                <?php
                                                if ($order['status'] + 1 == $status['status_code']) :
                                                ?>
                                                    <a href="#update-modal" data-transaction-no="<?php echo $order['transaction_no'] ?>" data-status="<?php echo $status['status_code'] ?>" data-status-text="<?php echo $status['status_label'] ?>" class=" text-decoration-none" data-bs-toggle="modal">
                                                        <p class="title"><?php echo $status['status_label'] ?></p>
                                                        <p class="my-1">
                                                            <small>
                                                                <?php echo $status['description'] ?>
                                                            </small>
                                                        </p>
                                                    </a>
                                                <?php
                                                else :
                                                ?>
                                                    <p class="title"><?php echo $status['status_label'] ?></p>
                                                    <p class="my-1">
                                                        <small>
                                                            <?php echo $status['description'] ?>
                                                        </small>
                                                    </p>
                                                <?php
                                                endif
                                                ?>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <?php include './includes/modals/orders-modals.php' ?>
    <?php include './includes/scripts.php' ?>
    <?php include './includes/alerts.php' ?>
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

        $("#update-modal").on("show.bs.modal",function(e){
            const status = $($(e.relatedTarget)).data("status")
            const statusText = $($(e.relatedTarget)).data("status-text")
            const transactionNo = $($(e.relatedTarget)).data('transaction-no');
            $("#status-txt").html(statusText);
            $("#confirm-btn").attr("href",`update-order-status.php?status=${status}&transaction_no=${transactionNo}`)
        })
    </script>
</body>

</html>