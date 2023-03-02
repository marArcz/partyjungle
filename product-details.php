<?php include './conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<?php include './includes/verifyUserSession.php' ?>
<?php include './admin/includes/OrderStatus.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Jungle Toys & Party Needs</title>
    <?php $active_page = "products" ?>
    <?php include './includes/header.php' ?>
    <style>
        #product-image-preview {
            width: 100% !important;
            height: 400px !important;
            border: 4px solid white !important;
            background-size: contain !important;
        }
    </style>
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
            <?php
            if (!isset($_GET['id'])) {
                Session::redirectTo("products.php");
                exit();
            }
            // get product
            $product_id = $_GET['id'];
            $product = mysqli_query($con, "SELECT * FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $product_id")->fetch_assoc();
            // get category
            $category = mysqli_query($con, "SELECT * FROM categories WHERE id=" . $product['category_id'])->fetch_assoc();
            // get available products
            $stocks = $product['stocks'];
            $available = $stocks;
            $cancelled = OrderStatus::$CANCELLED;
            $in_order = mysqli_query($con, "SELECT SUM(quantity) FROM order_details WHERE order_id IN (SELECT id FROM orders WHERE status != $cancelled)")->fetch_array()[0];
            $available -= $in_order;
            ?>
            <div class="container my-5">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="products.php" class="link-orange">Products</a></li>
                        <li class="breadcrumb-item"><a href="products.php?category=<?php echo $product['category_name'] ?>" class="link-orange"><?php echo $product['category_name'] ?></a></li>
                        <li class="breadcrumb-item active text-dark" aria-current="page"><?php echo $product['product_name'] ?></li>
                    </ol>
                </nav>
                <div class="row gy-3">
                    <div class="col-md-5 col-sm-6">
                        <div data-image="<?php echo $product['photo'] ?>" id="product-image-preview" class="div-image xl mb-2 border border-light border-3" alt=""></div>
                        <div class="d-flex p-2 bg-white photos-row w-100 overflow-scroll">
                            <img src="<?php echo $product['photo'] ?>" class="img-thumbnail my-2 mx-2 product-image" width="60" height="60" alt="">
                            <?php
                            $query = mysqli_query($con, "SELECT * FROM product_photos WHERE product_id = $product_id");
                            while ($row = $query->fetch_assoc()) {
                            ?>
                                <img src="<?php echo $row['photo'] ?>" alt="" class="img-thumbnail my-2 mx-2 product-image" width="60" height="60">
                            <?php
                            }
                            ?>

                            <?php
                            if ($product['is_variation_enabled'] == 1) {
                                $get_variations = mysqli_query($con, "SELECT * FROM variations WHERE product_id = $product_id");

                                while ($variation = $get_variations->fetch_assoc()) {
                                    $variation_id = $variation['id'];
                                    $get_property_values = mysqli_query($con, "SELECT property_values.value, properties.property_name FROM property_values INNER JOIN properties ON property_values.property_id = properties.id WHERE property_values.variation_id = $variation_id AND properties.property_name = 'Image'");

                                    while ($property = $get_property_values->fetch_assoc()) {
                                        if ($property['value'] != $product['photo']) {
                            ?>
                                            <img src="<?php echo $property['value'] ?>" alt="" class="img-thumbnail my-2 mx-2 product-image" width="60" height="60">
                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card rounded-1 border-0 shadow-sm">
                            <div class="card-header bg-brown text-light">
                                <p class="my-1">About Product</p>
                            </div>
                            <div class="card-body p-4">
                                <p class="my-0">
                                    <span class="badge text-bg-yellow">
                                        <?php echo $product['category_name'] ?>
                                    </span>
                                </p>
                                <div class="row mt-3 mb-0">
                                    <div class="col-md">
                                        <p class="fs-2">
                                            <?php echo $product['product_name'] ?>
                                        </p>
                                    </div>
                                    <div class="col-md text-end">
                                        <?php
                                        // check if product has enabled variation
                                        if ($product['is_variation_enabled'] == 1) {
                                            // get min and max price
                                            $price_text = "";
                                            $get_prices = mysqli_query($con, "SELECT MIN(CAST(value AS SIGNED)) AS min_price,  MAX(CAST(value AS SIGNED)) AS max_price FROM property_values WHERE property_id IN (SELECT id FROM properties WHERE product_id = $product_id AND property_name='Price')");
                                            if ($get_prices->num_rows > 0) {
                                                $prices = $get_prices->fetch_assoc();
                                                if ($prices['min_price'] == $prices['max_price']) {
                                                    $price_text = $prices['min_price'];
                                                } else {
                                                    $price_text = $prices['min_price'] . "-" . $prices['max_price'];
                                                }
                                            } else {
                                                $price_text = $product['price'];
                                            }
                                        } else {
                                            $price_text = $product['price'];
                                        }
                                        ?>
                                        <h4 class="text-orange"><strong>₱</strong> <span id="text-price"><?php echo $price_text ?></span></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="">
                                    <p class="fs-6 mb-3 text-secondary mb-0">Product Details</p>
                                    <p class="mb-4"><?php echo $product['description'] ?></p>

                                    <form action="add-to-cart.php" id="add-to-cart-form" method="post">
                                        <input type="hidden" value="<?php echo $_GET['id'] ?>" name="product_id">

                                        <!-- variations -->
                                        <?php
                                        // get variations
                                        $get_variations = mysqli_query($con, "SELECT * FROM variations WHERE product_id = $product_id");
                                        if ($product['is_variation_enabled'] == 1 && $get_variations->num_rows > 0) {
                                        ?>
                                            <p class="mt-1 mb-3 text-secondary">Variation:</p>
                                            <select name="variation_id" class="form-select mb-3" required id="select-variation">
                                                <option value="">Select Variation</option>
                                                <?php

                                                while ($variation = $get_variations->fetch_assoc()) {
                                                    $variation_id = $variation['id'];
                                                    $get_property_values = mysqli_query($con, "SELECT property_values.value, properties.property_name FROM property_values INNER JOIN properties ON property_values.property_id = properties.id WHERE variation_id = $variation_id AND properties.property_name != 'Image' AND properties.property_name != 'Price' ORDER BY properties.property_name DESC");
                                                    $count = $get_property_values->num_rows;
                                                    $i = 0;
                                                    $val = "";
                                                    while ($property = $get_property_values->fetch_assoc()) {
                                                        $val .= $property['value'] . ($i + 1 == $count ? '' : ', ');
                                                        $i++;
                                                    }

                                                    // display val
                                                ?>
                                                    <option value="<?php echo $variation['id'] ?>"><?php echo $val ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="variation" id="input-variation" value="">
                                        <?php
                                        }
                                        ?>

                                        <!-- quantity -->
                                        <label for="" class="form-label text-secondary">Quantity:</label>
                                        <input max="<?php echo $available ?>" type="number" name="quantity" class="rounded-pill px-3 form-control text-center fw-bold text-orange" value="1" min="1">
                                        <?php
                                        if ($available > 0) {
                                        ?>
                                            <p class="mt-2 fw-bold">Available: <span class="text-dark"><?php echo $available ?></span></p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="mt-2 fs-5 text-danger text-center">Sold Out</p>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($category['category_name'] == "Balloons") {
                                        ?>
                                            <label for="" class="form-label text-orange fw-bold">Instructions:</label>
                                            <textarea name="instruction" placeholder="Enter your instruction for customization here." required class="form-control" id="" rows="5"></textarea>
                                        <?php
                                        }
                                        ?>
                                        <div class="row align-items-center mt-3">
                                            <div class="col-md">
                                                <p class="my-1 fs-6 text-secondary">Party Jungle Party Needs and Toys</p>
                                            </div>
                                            <div class="col-md text-end">
                                                <?php
                                                if ($available > 0) {
                                                ?>
                                                    <button class="mt-2 btn btn-yellow px-3 rounded-pill btn-lg mt-3 fs-6" type="submit" name="submit">
                                                        <small class="text-dark">
                                                            <span class="bx bxs-cart"></span>
                                                            Add to cart
                                                        </small>
                                                    </button>
                                                <?php
                                                } else {
                                                ?>

                                                <?php
                                                }
                                                ?>
                                            </div>
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
        $(".product-image").on("click", function(e) {
            let img = $(this).attr("src");

            $("#product-image-preview").css("background-image", `url(${img})`);
        })

        $("#select-variation").on("change", function(e) {
            let variation_id = $(this).val();
            let val = $(this).find('option:selected').html()
            showLoading();
            $.ajax({
                url: "get-variation.php",
                method: "GET",
                data: {
                    variation_id
                },
                dataType: 'json',
                success: function(res) {
                    $("#text-price").html(res.price)
                    $("#product-image-preview").css("background-image", `url(${res.image})`);
                    console.log('res: ', res)
                    hideLoading()
                    
                    $("#input-variation").val(val)
                },
                error: err => console.log("error: ", err)
            })
        })
    </script>
</body>

</html>