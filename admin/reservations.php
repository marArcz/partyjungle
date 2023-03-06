<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Reservations | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "product_reservations";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-time bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Product Reservations</p>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive-md">
                                <table class="table align-middle" id="table">
                                    <thead>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM reservations");
                                        while ($row = $query->fetch_assoc()) {
                                            $product_id = $row['product_id'];
                                            $user_id = $row['user_id'];
                                            $product = mysqli_query($con, "SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
                                            $customer = mysqli_query($con, "SELECT * FROM users WHERE id = $user_id")->fetch_assoc();
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <?php
                                                        if (!empty($customer['photo']) || $customer['photo'] == '../') {
                                                        ?>
                                                            <div class="div-image border shadow-sm border-3 view-photo rounded-circle div-image-sm" data-image="<?php echo "../" . $customer['photo'] ?>"></div>

                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="user-text-photo sm">
                                                                <span><?php echo $customer['firstname'][0] . $customer['lastname'][0] ?></span>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <p class="my-1 ms-2"><?php echo $customer['firstname'] . ' ' . $customer['lastname'] ?> </p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="my-1"><?php echo $product['product_name'] ?> / <?php echo $row['variation'] ?></p>
                                                </td>
                                                <td><?php echo $row['quantity'] ?></td>
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

    <?php include './includes/scripts.php' ?>
    <script>

    </script>
</body>

</html>