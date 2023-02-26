<?php include './conn/conn.php' ?>
<?php include './includes/Session.php' ?>
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

<body class="bg-light">
    <?php include './includes/top_header.php' ?>
    <main class="main">
        <section>
            <?php
            if (!isset($_GET['id'])) {
                Session::redirectTo("services.php");
                exit();
            }
            $user_id = Session::getUser()['id'];
            // get product
            $service_id = $_GET['id'];
            $service = mysqli_query($con, "SELECT * FROM services WHERE id = $service_id")->fetch_assoc();
            ?>
            <div class="container my-5">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="services.php" class="link-orange">Services</a></li>
                        <li class="breadcrumb-item active text-dark" aria-current="page"><?php echo $service['name'] ?></li>
                    </ol>
                </nav>
                <div class="row gy-3">
                    <div class="col-md-5 col-sm-6">
                        <img src="<?php echo $service['photo'] ?>" class="img-fluid img-thumbnail" alt="">

                    </div>
                    <div class="col">
                        <div class="card rounded-1 border-0 shadow-sm">
                            <div class="card-header bg-brown text-light">
                                <p class="my-1">Service Details</p>
                            </div>
                            <div class="card-body p-4">
                                <div class="row mt-3 mb-0">
                                    <div class="col-md">
                                        <p class="fs-2">
                                            <?php echo $service['name'] ?>
                                        </p>
                                    </div>
                                </div>

                                <hr>
                                <div class="">
                                    <p class="fs-6 mb-3 text-secondary mb-0">Description</p>
                                    <p class="mb-4"><?php echo $service['description'] ?></p>

                                    <form action="schedule-service.php" method="get">
                                        <input type="hidden" name="service_id" value="<?php echo $service['id'] ?>">
                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM service_options WHERE service_id = $service_id");
                                        while ($row = $query->fetch_assoc()) {
                                        ?>
                                            <div class="form-check mb-4">
                                                <input class="form-check-input" required type="radio" value="<?php echo $row['id'] ?>" name="option_id" id="service-option-<?php echo $row['id'] ?>">
                                                <label class="form-check-label" for="service-option-<?php echo $row['id'] ?>">
                                                    <?php echo $row['label'] ?> -
                                                    <span class="text-orange">₱ <?php echo $row['price'] ?></span>
                                                </label>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="d-grid">
                                            <button class="btn btn-orange" type="submit">
                                                <div class="d-flex align-items-center">
                                                    <span class="ms-auto me-auto">Continue</span>
                                                    <i class="bx bx-right-arrow-alt"></i>
                                                </div>
                                            </button>
                                        </div>
                                    </form>
                                </div>


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
    <!-- footer -->
    <?php include './includes/footer.php' ?>
    <?php include './includes/scripts.php' ?>
    <script>
        // $("#add-to-cart-form").on("submit", function(e) {

        // })
    </script>
</body>

</html>