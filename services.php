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

<body class="bg-white">
    <?php include './includes/top_header.php' ?>
    <?php
    $query = mysqli_query($con, "SELECT * FROM categories LIMIT 1");
    $category_row = $query->fetch_assoc();
    $category = isset($_GET['category']) ? $_GET['category'] : "all";
    ?>
    <main class="main">
        <section>
            <div class="container my-5">
                <h3 class="fw-bold text-secondary">Services</h3>

                <hr>
                <?php
                if (isset($_GET['search'])) {
                ?>
                    <a href="products.php?category=<?php echo $category ?>" class="btn btn-outline-dark mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-x me-2"></i>
                            <span>Results found for: <strong><?php echo $_GET['search'] ?></strong></span>
                        </div>
                    </a>
                <?php
                }
                ?>
                <!-- products -->
                <div class="row gy-3 gx-1 pb-5">
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM services");
                    while ($row = $query->fetch_assoc()) {
                    ?>
                        <!-- product -->
                        <div class="col-6 col-lg-3">
                            <a href="service-details.php?id=<?php echo $row['id'] ?>" class="">
                                <div class="card product-card rounded-1 shadow-sm position-relative">
                                    <img src="<?php echo $row['photo'] ?>" class="card-img-top rounded-0 img-thumbnail" alt="...">
                                    <div class="card-body py-3">
                                        <div class="row">
                                            <div class="col-12 text-truncate product-name fs-6">
                                                <?php echo $row['name'] ?>
                                            </div>
                                        </div>
                                        <p class="col-12 text-truncate text-secondary my-1">
                                            <small><?php echo $row['description'] ?></small>
                                        </p>
                                    </div>

                                    <div class="position-absolute product-footer start-0 w-100 text-center p-1">
                                        <p class="my-1">
                                            <small>View Product</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php
                    }
                    if ($query->num_rows == 0) {
                    ?>
                        <h5 class="text-center">No services to show.</h5>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <?php include './includes/featured-products.php' ?>
    </main>
    <?php include './includes/footer.php' ?>
    <?php include './includes/scripts.php' ?>
</body>

</html>