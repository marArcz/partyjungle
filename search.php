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
    <?php $active_page = "products" ?>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-light">
    <?php include './includes/top_header.php' ?>
    <?php
    $query = mysqli_query($con, "SELECT * FROM categories LIMIT 1");
    $category_row = $query->fetch_assoc();
    $category = isset($_GET['category']) ? $_GET['category'] : "all";
    ?>
    <main class="main">
        <section>

            <div class="container my-5">
                <h3 class="fw-bold text-secondary">Products</h3>

                <!-- categories -->
                <div class="categories-container mb-4">
                    <a href="products.php?category=all" class="link-dark">
                        <div class="card category-item <?php echo $category === "all" ? "active" : "" ?>">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-category fs-5 me-2 <?php echo $category === "all" ? "text-orange" : "" ?>"></i>
                                    <p class="my-1 text-center">All</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <?php
                    if ($category !== "all") {
                        $category_row = mysqli_query($con, "SELECT * FROM categories WHERE category_name = '$category'")->fetch_assoc();
                    ?>
                        <div>
                            <div class="card category-item active">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="<?php echo $category_row['category_photo'] ?>" class="img-fluid me-2" alt="">
                                        <p class="my-1 text-center"><?php echo $category_row['category_name'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    $query = mysqli_query($con, "SELECT * FROM categories WHERE category_name != '$category'");
                    while ($row = $query->fetch_assoc()) {
                    ?>
                        <a href="products.php?category=<?php echo $row['category_name'] ?><?php echo isset($_GET['search'])? "&search=".$_GET['search']:"" ?>">
                            <div class="card category-item">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="<?php echo $row['category_photo'] ?>" class="img-fluid me-2" alt="">
                                        <p class="my-1 text-center text-dark"><?php echo $row['category_name'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                </div>
                <!-- end of categories -->
                <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '>';">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fw-bold text-secondary">Products</li>
                        <li class="breadcrumb-item active text-dark fw-bold" aria-current="page"><?php echo strtoupper($category) ?></li>
                    </ol>
                </nav>
                <hr>
                <!-- products -->
                <div class="row gy-3 gx-1 pb-5">
                    <?php
                    if ($category === "all") {
                        $query = mysqli_query($con, "SELECT products.*, categories.category_name FROM products INNER JOIN categories ON products.category_id = categories.id");
                    } else {
                        $query = mysqli_query($con, "SELECT products.*, categories.category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE categories.category_name = '$category'");
                    }

                    while ($row = $query->fetch_assoc()) {
                    ?>
                        <!-- product -->
                        <div class="col-6 col-lg-2">
                            <a href="product-details.php?id=<?php echo $row['id'] ?>" class="">
                                <div class="card product-card rounded-0 position-relative">
                                    <img src="<?php echo $row['photo'] ?>" class="card-img-top rounded-0 img-thumbnail" alt="...">
                                    <div class="card-body py-1">
                                        <div class="row">
                                            <div class="col-12 text-truncate product-name">
                                                <?php echo $row['product_name'] ?>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <p class="my-1 product-price">
                                            ₱ <?php echo $row['price'] ?>
                                            </p>
                                        </div>
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
                    ?>
                </div>
            </div>
        </section>
        <?php include './includes/featured-products.php' ?>
    </main>
    <?php include './includes/footer.php' ?>
    <?php include './includes/scripts.php' ?>
    <script>

    </script>
</body>

</html>