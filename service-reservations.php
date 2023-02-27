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
    <?php $active_page = "reservations" ?>
    <?php include './includes/header.php' ?>
</head>

<body class="">
    <?php include './includes/top_header.php' ?>
    <?php
    $query = mysqli_query($con, "SELECT * FROM categories LIMIT 1");
    $category_row = $query->fetch_assoc();
    $category = isset($_GET['category']) ? $_GET['category'] : "all";
    ?>
    <main class="main">
        <section>
            <div class="container my-5">

                <h4 class="text-dark fw-light">Service Reservations</h4>
                <hr>
                <?php
                $user_id = Session::getUser()['id'];
                $query = mysqli_query($con, "SELECT * FROM service_reservations WHERE user_id = $user_id");
                while ($row = $query->fetch_assoc()) {
                    $option = mysqli_query($con, "SELECT * FROM service_options WHERE id = " . $row['service_option_id'])->fetch_assoc();
                    $service = mysqli_query($con, "SELECT * FROM services WHERE id = " . $row['service_id'])->fetch_assoc();
                ?>

                    <div class="card border-0 shadow rounded-1">
                        <div class="card-body p-4">
                            Status
                        </div>
                    </div>
                <?php
                }
                ?>

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