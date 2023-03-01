<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "dashboard";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <a href="products.php" class="text-decoration-none">
                            <span class="card-icon card-icon-sm me-2 shadow-sm">
                                <i class="bx bx-arrow-back bx-sm"></i>
                            </span>
                        </a>
                        <p class="fs-4 fw-bold my-0"> Manage Product</p>
                    </div>
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <!-- GET PRODUCT -->
                            <?php
                            // get product
                            $product_id = $_GET['id'];
                            $product = mysqli_query($con, "SELECT products.*,categories.category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $product_id")->fetch_assoc();

                            ?>
                            <div class="row gy-3">
                                <div class="col-md-4 text-center">
                                    <img src="../<?php echo $product['photo'] ?>" id="edit-image-preview" class="img-fluid mb-1 img-thumbnail" alt="">
                                    <div class="text-center">
                                        <p class=" text-secondary mt-1 mb-2">
                                            <small>Main Photo</small>
                                        </p>
                                        <button class="btn btn-orange file-input-toggler" data-target="#edit-file-input" type="button">Change Image</button>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <input type="file" data-img-preview="#edit-image-preview" name="photo" class="d-none" id="edit-file-input">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Name:</label>
                                        <input type="text" required class="form-control" name="name" value="<?php echo $product['product_name'] ?>" id="edit-name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Category:</label>
                                        <select required name="category_id" class="form-select" id="edit-category">
                                            <option value="">Select one</option>
                                            <?php
                                            $query = mysqli_query($con, "SELECT * FROM categories");
                                            while ($row = $query->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $row['id'] ?>">
                                                    <?php echo $row['category_name'] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Price:</label>
                                        <input required type="number" name="price" id="edit-price" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Stocks:</label>
                                        <input required type="number" name="stocks" class="form-control" id="edit-stocks">
                                    </div>
                                    <div class="mb-3">
                                        <label for="" class="form-label">Product Description:</label>
                                        <textarea required name="description" class="form-control" rows="5" id="edit-description"></textarea>
                                    </div>
                                    <div class="my-4">
                                        <hr>
                                        <p class="form-text">Product Photos</p>
                                        <input type="file" multiple id="edit-photo-input" class="d-none">
                                        <div class="text-end mb-3">
                                            <button class="btn btn-brown btn-sm file-input-toggler" data-target="#edit-photo-input" type="button">Add Photo</button>
                                        </div>
                                        <div class="photos-row" id="edit-photos-row">
                                            <?php
                                            // $get_photos = mysqli_query($con,"SELECT * FROM product_photos WHERE product_id")
                                            ?>

                                        </div>
                                    </div>
                                </div>
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