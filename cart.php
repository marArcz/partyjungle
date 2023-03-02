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
    <?php $active_page = "cart" ?>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-light">
    <?php include './includes/top_header.php' ?>

    <main class="main">
        <section class="cart">
            <div class="container">
                <div class="row gx-0 mt-4 shadow-sm mb-3">
                    <div class="col-md-8">
                        <div class="card rounded-0 border-0 h-100 p-lg-4">
                            <div class="card-body ">
                                <?php
                                $user_id = Session::getUser()['id'];
                                // get total items in cart
                                $total_items = mysqli_query($con, "SELECT SUM(quantity) FROM cart WHERE user_id = $user_id AND is_checked_out=0")->fetch_array()[0];
                                ?>
                                <div class="d-flex">
                                    <p class="my-1 fw-bold">Shopping Cart</p>
                                    <p class="my-1 ms-auto">
                                        <span class="total-items"><?php echo $total_items ?></span> <?php echo $total_items > 1 ? "Items" : "Item" ?>
                                    </p>
                                </div>
                                <hr>
                                <!-- <div class="table-responsive-sm px-0">
                                    <table class="table table-borderless ">
                                        <thead>
                                            <th class="fw-light text-secondary"><small>PRODUCT DETAILS</small></th>
                                            <th class="fw-light text-secondary text-center"><small>QUANTITY</small></th>
                                            <th class="fw-light text-secondary"><small>PRICE</small></th>
                                            <th class="fw-light text-secondary"><small>TOTAL</small></th>
                                            <th class="fw-light text-secondary text-center"><small>REMOVE</small></th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total_price = 0;
                                            $query = mysqli_query($con, "SELECT * FROM cart WHERE user_id = $user_id");
                                            while ($row = $query->fetch_assoc()) {
                                                $total_price +=  $row['price'] * $row['quantity'];
                                                $category = mysqli_query($con, "SELECT * FROM categories WHERE id=" . $row['category_id'])->fetch_assoc();
                                            ?>
                                                <tr id="cart-row-<?php echo $row['id'] ?>">
                                                    <td>
                                                        <div class="d-flex flex-wrap">
                                                            <img src="<?php echo $row['product_photo'] ?>" class="me-2 img-fluid img-thumbnail" width="100" alt="">
                                                            <div class="">
                                                                <p class="my-1">
                                                                    <?php echo $row['product_name'] ?>
                                                                </p>
                                                                <p class="my-1 fw-light text-orange">
                                                                    <small><?php echo $category['category_name'] ?></small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center quantity-input-group justify-content-center">
                                                            <button class="btn btn-default btn-sm quantity-control" data-row="cart-row-<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>" type="button">
                                                                <i class="bx bx-plus text-secondary"></i>
                                                            </button>
                                                            <input type="number" name="quantity" class="quantity-input form-control form-control-sm" value="<?php echo $row['quantity'] ?>">
                                                            <button class="btn btn-default btn-sm quantity-control" data-row="cart-row-<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>" type="button">
                                                                <i class="bx bx-minus text-secondary"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <small class="text-secondary">₱ <?php echo $row['price'] ?></small>
                                                    </td>
                                                    <td>
                                                        <small class="text-secondary">₱ <?php echo $row['price'] * $row['quantity'] ?></small>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="remove-product.php?id=<?php echo $row['id'] ?>" class="link-secondary fs-5">
                                                            <i class="bx bx-x"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div> -->

                                <?php
                                $subtotal = 0;

                                if ($total_items > 0) {
                                ?>
                                    <ul class="list-group list-group-flush cart-list">
                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM cart WHERE user_id = $user_id AND is_checked_out=0 ORDER BY id DESC");
                                        while ($row = $query->fetch_assoc()) {
                                            $total_price = 0;
                                            $total_price +=  $row['price'] * $row['quantity'];
                                            $subtotal += $total_price;
                                            $category = mysqli_query($con, "SELECT * FROM categories WHERE id=" . $row['category_id'])->fetch_assoc();
                                        ?>
                                            <li class="list-group-item" id="cart-row-<?php echo $row['id'] ?>">
                                                <div class="row align-items-center ">
                                                    <div class="col-12 col-md-3">
                                                        <img src="<?php echo $row['product_photo'] ?>" class=" img-fluid img-thumbnail" alt="">
                                                    </div>
                                                    <div class="col">
                                                        <div class="row align-items-center">
                                                            <div class="col-md">
                                                                <?php
                                                                if ($category['category_name'] == 'Balloons') {
                                                                ?>
                                                                    <a href="#instruction-modal" data-bs-toggle="modal" data-instruction="<?php echo $row['instruction'] ?>">
                                                                        <i class="bx bx-info-circle"></i>
                                                                    </a>
                                                                <?php
                                                                }
                                                                ?>
                                                                <p class="my-1"><small><?php echo $row['product_name'] ?></small></p>
                                                                <p class="my-0 text-secondary">
                                                                    <small><?php echo $row['variation'] ?></small>
                                                                </p>
                                                                <p class="my-1 text-orange"><small><strong>₱</strong> <?php echo $row['price'] ?></small></p>
                                                            </div>
                                                            <div class="col-md">
                                                                <div class="d-flex align-items-center">
                                                                    <button data-id="<?php echo $row['id'] ?>" data-control="inc" class="btn bg-opacity-50 btn-light border fw-bold btn-sm quantity-control" data-row="#cart-row-<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>" type="button">
                                                                        <i class="bx bx-plus"></i>
                                                                    </button>
                                                                    <span class="fw-bolder badge text-bg-light quantity-label rounded-1 px-3 py-2"><?php echo $row['quantity'] ?></span>
                                                                    <button data-id="<?php echo $row['id'] ?>" data-control="dec" class="btn bg-opacity-50 btn-light border fw-bold btn-sm quantity-control" data-row="#cart-row-<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>" type="button">
                                                                        <i class="bx bx-minus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <p class="fw-bold">₱ <span class="total-price"><?php echo $total_price ?></span></p>
                                                    </div>
                                                    <div class="col text-center">
                                                        <a href="remove-cart-item.php?id=<?php echo $row['id'] ?>">
                                                            <i class="bx bx-x fs-5 text-orange"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                        <li class="list-group-item"></li>
                                    </ul>
                                <?php
                                } else {
                                ?>
                                    <div class="text-center">
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-md-4">
                                                <img src="./assets/images/ban_img1.png" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                        <p class="text-center text-secondary">You have no item in your cart.</p>
                                        <a href="products.php" class="btn btn-orange px-3 rounded-pill">Shop now</a>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="card border-0 rounded-0 bg-yellow h-100 p-lg-4">
                            <div class="card-body">
                                <p class="my-1 fw-bold">Order Summary</p>
                                <hr>
                                <div class="d-flex">
                                    <div>
                                        <p class="text-dark fw-bold my-1">
                                            <span>ITEMS <span class="total-items"><?php echo $total_items ?></span></span>
                                        </p>
                                    </div>
                                    <div class="ms-auto">
                                        <p class="text-dark fw-bold my-1">
                                            <span><strong>₱</strong> <span id="subtotal"><?php echo $subtotal ?></span></span>
                                        </p>
                                    </div>
                                </div>
                                <form action="checkout-page.php" method="post" class="mt-3">
                                    <div class="mb-3">
                                        <label for="" class="form-label">SHIPPING</label>
                                        <select name="shipping_type" class="form-select" id="shipping-type">
                                            <?php
                                            $shipping = mysqli_query($con, "SELECT * FROM shipping LIMIT 1")->fetch_assoc();
                                            ?>
                                            <?php
                                            $query = mysqli_query($con, "SELECT * FROM shipping");
                                            while ($s = $query->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $s['id'] ?>"><?php echo $s['description'] ?> - <?php echo $s['price'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <hr>
                                    <div class="d-flex">
                                        <p class="my-1">
                                            TOTAL PRICE
                                        </p>
                                        <p class="my-1 ms-auto">
                                            ₱ <span id="total-price"><?php echo $subtotal > 0 ? $subtotal + $shipping['price'] : 0 ?></span>
                                        </p>
                                    </div>

                                    <div class="mt-3">
                                        <button name="submit" <?php echo $total_items == 0 ? "disabled" : "" ?> type="submit" class="btn btn-orange rounded-pill px-4 py-2">
                                            CHECKOUT
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        // include './includes/featured-products.php';
        ?>
    </main>
    <?php include './includes/footer.php' ?>
    <?php include './includes/cart-modals.php' ?>
    <?php include './includes/scripts.php' ?>

    <script>
        var shippingFee = 50;
        $(".quantity-control").on("click", function(e) {
            var row = $($(this).data("row"));
            const qlabel = row.find(".quantity-label");
            const cart_id = $(this).data('id');
            var quantity = Number(qlabel.html());
            var shipping_id = $("#shipping-type").val();
            console.log('shipping id: ', shipping_id)
            if ($(this).data("control") === "inc") {
                quantity++;
            } else {
                quantity--;
            }
            showLoading();
            if (quantity === 0) {
                $.ajax({
                    url: "remove-cart-item.php",
                    method: "post",
                    data: {
                        cart_id,
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log('res: ', res);
                        window.location.reload();
                    },
                    error: function(err) {
                        console.log('error: ', err)
                    }
                })
            } else {
                $.ajax({
                    url: "update-cart-quantity.php",
                    method: "post",
                    data: {
                        cart_id,
                        quantity,
                        shipping_id
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log('res: ', res);
                        hideLoading();
                        qlabel.html(quantity)

                        var totalPrice = res.item.price * res.item.quantity;

                        row.find(".total-price").html(totalPrice)
                        $("#subtotal").html(res.subtotal)
                        $(".total-items").html(res.total_items)

                        $("#total-price").html(res.subtotal + Number(res.shipping.price))
                    },
                    error: function(err) {
                        console.log('error: ', err)
                    }
                })
            }
        })

        $("#shipping-type").on('change', function(e) {
            const id = $(this).val();
            $.ajax({
                url: "get-shipping.php",
                method: "POST",
                data: {
                    id
                },
                dataType: "json",
                success: function(res) {
                    $("#total-price").html(res.total_price)
                }
            })
        })

        $("#instruction-modal").on("show.bs.modal", function(e) {
            let text = $(e.relatedTarget).data("instruction");
            $("#instructions-text").html(text)
        })
    </script>
</body>

</html>