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
    <?php $active_page = "product_reservations" ?>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-light">
    <?php include './includes/top_header.php' ?>
    <?php
    $user_id = Session::getUser()['id'];

    $status = !isset($_GET['status']) ? "All" : $_GET['status'];

    $query = mysqli_query($con, "SELECT * FROM categories LIMIT 1");
    $category_row = $query->fetch_assoc();
    $category = isset($_GET['category']) ? $_GET['category'] : "all";
    ?>
    <main class="main">
        <section>
            <div class="container my-5">

                <h4 class="text-dark fw-light"><i class="bx bxs-time text-orange"></i> Reservations</h4>
                <hr>
                <div class="card border-0 shadow-sm bg-white">
                    <div class="card-body p-4">
                        <div class="table-responsive-md">
                            <table class="table">
                                <thead>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $user_id = Session::getUser()['id'];
                                    $query = mysqli_query($con, "SELECT * FROM reservations WHERE user_id = $user_id");
                                    while ($row = $query->fetch_assoc()) {
                                        $product = mysqli_query($con, "SELECT products.*,categories.category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.id=" . $row['product_id'])->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td><?php echo $product['product_name'] ?></td>
                                            <td><?php echo $product['category_name'] ?></td>
                                            <td><?php echo $row['quantity'] ?></td>
                                            <td>
                                                <a href="remove-reservation.php?id=<?php echo $row['id'] ?>" class="link-danger">
                                                    <i class="bx bx-trash"></i>
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
        <?php
        include './includes/featured-products.php';
        ?>
    </main>
    <?php include './includes/chat.php' ?>
    <?php include './includes/footer.php' ?>
    <?php include './includes/reservation-modal.php' ?>
    <?php include './includes/scripts.php' ?>
</body>

</html>