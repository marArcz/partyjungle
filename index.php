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
    <?php $active_page = "home" ?>
    <?php include './includes/header.php' ?>
</head>

<body>
    <?php include './includes/top_header.php' ?>

    <main class="main">
        <section class="hero-main pt-5 pb-5">
            <div class="container">
                <div class="row gy-4 align-items-center">
                    <div class="col-md">
                        <h1 class="text-yellow hero-text mb-2">Party Jungle</h1>
                        <h1 class="text-orange mb-4 hero-text">Party Needs & Toys</h1>
                        <h3 class="mt-5">We offer retail and wholesale of super affordable party needs, toys, ride on cars.</h3>
                        <a href="products.php" class="btn btn-primary px-5 py-2 mt-4 rounded-pill">SHOP NOW</a>
                    </div>
                    <div class="col-md-4">
                        <img src="./assets/images/ban_img1.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="">
            <div class="row gx-0">
                <?php
                $query = mysqli_query($con, "SELECT * FROM categories");
                $i = 1;
                while ($row = $query->fetch_assoc()) {
                ?>
                    <div class="col-6 col-md-3 text-center">
                        <a href="products.php?category=<?php echo $row['category_name'] ?>" class="link-light">
                            <div class="card border-0 rounded-0 <?php echo $i % 2 == 0 ? "bg-yellow" : "bg-orange" ?>">
                                <div class="card-body text-center">
                                    <img src="<?php echo $row['category_photo'] ?>" alt="" class="img-fluid mb-3">

                                    <p class="text-light my-0">
                                        <?php echo $row['category_name'] ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                    $i++;
                }
                ?>
            </div>
        </section>
        <?php
        include './includes/featured-products.php';
        ?>
    </main>
    <?php include './includes/footer.php' ?>
    <?php include './includes/chat.php' ?>

    <?php include './includes/scripts.php' ?>
</body>

</html>