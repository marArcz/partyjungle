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

<body>
    <?php include './includes/top_header.php' ?>

    <main class="main">
        <section class="">
            <div class="container my-5">
                <h3 class="fw-bold text-secondary mb-2">My Orders</h3>
                <div class="row justify-content-center ">
                    <div class="col-md-12">
                        <div class="card shadow border-0 ">
                            <div class="card-body">
                                <ul class="list-group list-group-flush">

                                    <?php
                                    $user_id = Session::getUser()['id'];
                                    $query = mysqli_query($con, "SELECT orders.*, shipping.description,shipping.price FROM orders INNER JOIN shipping ON orders.shipping_id = shipping.id WHERE orders.user_id = $user_id");
                                    while ($row = $query->fetch_assoc()) {
                                        $transaction_no = $row['transaction_no'];
                                        $description = $row['description'];
                                        $total = $row['total'];
                                        $status =  $row['status'];
                                        $order_id = $row['id'];
                                        //get order details
                                        $get_details = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = $order_id");
                                        while ($details = $get_details->fetch_assoc()) {
                                        }

                                    ?>
                                        <li class="list-group-item">
                                            <?php 
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

        <?php
        include './includes/featured-products.php';
        ?>
    </main>
    <?php include './includes/footer.php' ?>
    <?php include './includes/scripts.php' ?>
</body>

</html>