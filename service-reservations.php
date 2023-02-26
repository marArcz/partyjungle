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
    <?php $active_page = "services" ?>
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
                <a href="services.php" class="mb-3 ">
                    <i class="bx bx-arrow-back"></i> Services
                </a>
                <h4 class="text-dark"><i class="mt-3 text-orange bx bxs-book"></i> Service Reservations</h4>
                <div class="card border-0 shadow-sm rounded-1">
                    <div class="card-body p-4">
                        <div class="table-responsive-md">
                            <table class="table" id="table">
                                <thead>
                                    <th>Service</th>
                                    <th>Option</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>time</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $user_id = Session::getUser()['id'];
                                    $query = mysqli_query($con, "SELECT * FROM service_reservations WHERE user_id = $user_id");
                                    while ($row = $query->fetch_assoc()) {
                                        $option = mysqli_query($con,"SELECT * FROM service_options WHERE id = " . $row['service_option_id'])->fetch_assoc();
                                        $service = mysqli_query($con,"SELECT * FROM services WHERE id = " . $row['service_id'])->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td><?php echo $service['name'] ?></td>
                                            <td><?php echo $option['label'] ?></td>
                                            <td><?php echo $option['price'] ?></td>
                                            <td><?php echo date("M d, Y",strtotime($row['date'])) ?></td>
                                            <td><?php echo date("h:i a", strtotime($row['time'])) ?></td>
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
    <?php include './includes/footer.php' ?>
    <?php include './includes/scripts.php' ?>
</body>

</html>