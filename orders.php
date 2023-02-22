<?php include './conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<?php include './includes/verifyUserSession.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Jungle Toys & Party Needs</title>
    <?php $active_page = "orders" ?>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-light">
    <?php include './includes/top_header.php' ?>

    <main class="main">
        <section class="">
            <div class="container my-5">
                <h3 class="text-dark my-0 fw-light">
                    My Orders
                </h3>
                <hr class="mt-1">
                <div>
                    <?php
                    $user_id = Session::getUser()['id'];
                    $query = mysqli_query($con, "SELECT orders.*, shipping.description,shipping.price FROM orders INNER JOIN shipping ON orders.shipping_id = shipping.id WHERE orders.user_id = $user_id ORDER BY orders.status ASC, orders.ordered_at DESC");
                    while ($row = $query->fetch_assoc()) {
                        $transaction_no = $row['transaction_no'];
                        $description = $row['description'];
                        $total = $row['total'];
                        $status =  $row['status'];
                        $order_id = $row['id'];
                        //get order details 2 products only
                        $get_details = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id LIMIT 2");
                        $num_of_products = mysqli_query($con, "SELECT COUNT(*) FROM order_details WHERE order_id = $order_id")->fetch_array()[0];
                    ?>
                        <div class="card mb-3 rounded-3 shadow border-0">
                            <div class="card-body p-lg-4">
                                <div class="d-flex flex-wrap align-items-center">
                                    <p class=" shadow-sm text-bg-light badge rounded-pill py-2 px-3 fw-bold text-secondary">
                                        Order
                                        <span class="text-brown">#</span>
                                        <span class=" fw-normal text-dark"><?php echo $row['transaction_no'] ?></span>
                                    </p>
                                    <a href="order-details.php?transaction_no=<?php echo $transaction_no ?>" class="ms-auto my-2 btn btn-orange btn-sm rounded-3">
                                        <small><i class="bx bxs-info-circle"></i> View Order</small>
                                    </a>
                                </div>
                                <div class="px-3">
                                    <?php $status = mysqli_query($con, "SELECT * FROM order_status WHERE status_code=" . $row['status'])->fetch_assoc(); ?>
                                    <p class="my-1 text-secondary fw-light">Status</p>
                                    <p class="my-1 text-dark fw-bold"><?php echo $status['status_label'] ?></p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php
                                    while ($details = $get_details->fetch_assoc()) :
                                    ?>
                                        <li class="list-group-item">
                                            <div class="row mt-3 align-items-center">
                                                <div class="col-sm-5 col-6 col-md-3 col-lg-3">
                                                    <img src="<?php echo $details['product_photo'] ?>" alt="" class="img-fluid img-thumbnail">
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
                                <div class="px-4 mt-2">
                                    <?php
                                    if ($num_of_products > 2) {
                                    ?>
                                        <a href="order-details.php?transaction_no=<?php echo $transaction_no ?>" class=" fw-bold text-decoration-underline link-secondary"><?php echo $num_of_products - 2  ?> more... </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <p class="my-1 text-end text-black-50">
                                    <small>
                                        Order was placed on
                                        <?php echo date("M d, Y", strtotime($row['ordered_at'])) ?>
                                    </small>
                                </p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>

        <?php
        include './includes/featured-products.php';
        ?>
    </main>
    <?php include './includes/footer.php' ?>
    <?php include './includes/scripts.php' ?>
</body>

</html>