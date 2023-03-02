<?php include './conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<?php include './includes/verifyUserSession.php' ?>
<?php
if (!isset($_POST['submit'])) {
    Session::redirectTo("cart.php");
    exit();
}

$user_id = $user['id'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Jungle Toys & Party Needs</title>
    <?php $active_page = "checkout" ?>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-light">
    <?php include './includes/top_header.php' ?>
    <main class="main">
        <section class="cart">
            <div class="container py-4">
                <p class="fs-4 mt-3 fw-bold">
                    <i class='bx bxs-receipt text-orange'></i> Checkout
                </p>
                <div class="card border-0 rounded-0 shadow-sm border-top border-orange">
                    <div class="card-body p-4">
                        <?php
                        $shipping_type = $_POST['shipping_type'];
                        $user = Session::getUser();
                        ?>
                        <p class="text-orange">
                            <i class="bx bxs-map"></i> <span>Delivery Address</span>
                        </p>
                        <div class="d-flex flex-wrap">
                            <p class="me-auto my-0">
                                <?php
                                // get shipping address
                                $get_shipping_address = mysqli_query($con, "SELECT *, CONCAT(region,' ', province,', ',city,', ' ,zip_code,', ' ,barangay,' ', street_name, ' ',house_no)  as address FROM shipping_address WHERE user_id = $user_id");
                                if ($get_shipping_address->num_rows > 0) {
                                    $address = $get_shipping_address->fetch_assoc();
                                ?>
                                    <strong id="address-name"><?php echo $address['fullname'] ?></strong>
                                    <br>
                                    <span id="address-text" class="fw-light"><?php echo $address['address'] ?></span>
                                <?php
                                } else {
                                ?>
                                    <strong id="address-name"></strong>
                                    <br>
                                    <span id="address-text" class="fw-light">No Shipping address is added yet.</span>
                                <?php
                                }
                                ?>


                            </p>
                            <a href="#address-modal" data-bs-toggle="modal" class="">
                                <small>
                                    <?php
                                    echo $get_shipping_address->num_rows == 0 ? "Add Address" : "Change"
                                    ?>
                                </small>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- products to be checked out -->
                <div class="card border-0 shadow-sm mt-4 rounded-1 border-top">
                    <div class="card-body py-4">
                        <p class="fs-5 px-3 mt-3 ">
                            <i class='bx bxs-shopping-bag text-orange'></i>
                            Products Ordered
                        </p>
                        <?php
                        // get products from cart
                        $get_cart = mysqli_query($con, "SELECT * FROM cart WHERE user_id = $user_id AND is_checked_out = 0");
                        $subtotal = 0;
                        ?>
                        <ul class="list-group list-group-flush">
                            <?php
                            while ($cart = $get_cart->fetch_assoc()) {
                                $category_id = $cart['category_id'];
                                $category = mysqli_query($con, "SELECT * FROM categories WHERE id = $category_id")->fetch_assoc();
                                $subtotal += $cart['price'] * $cart['quantity'];
                            ?>
                                <li class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-lg-2 col-sm-3 col-4">
                                            <img src="<?php echo $cart['product_photo'] ?>" class="img-fluid img-thumbnail" alt="">
                                        </div>
                                        <div class="col">
                                            <div class="row gy-2 align-items-center">
                                                <div class="col-md">
                                                    <p class="my-1 text-truncate col-12">
                                                        <?php echo $cart['product_name'] ?>
                                                    </p>
                                                    <p class="my-1 text-truncate col-12 text-secondary">
                                                        <?php echo $cart['variation'] ?>
                                                    </p>
                                                    <div class="my-1 badge text-bg-brown text-light">
                                                        <?php echo $category['category_name'] ?>
                                                    </div>
                                                    <p class="my-1 text-orange">
                                                        <strong>₱</strong> <?php echo number_format($cart['price']) ?>
                                                    </p>
                                                </div>
                                                <div class="col-md">
                                                    <span class="text-secondary">Qty:</span> <strong><?php echo $cart['quantity'] ?></strong>
                                                </div>
                                                <div class="col-md">
                                                    <p class="my-1 text-secondary fw-light">
                                                        <small>Subtotal:</small>
                                                    </p>
                                                    <p class="my-1 text-orange">
                                                        <strong>₱</strong> <?php echo number_format($cart['price'] * $cart['quantity']) ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- payment method -->
                <div class="card border-0 shadow-sm mt-3 border-top border-brown">
                    <div class="card-body">
                        <div class="container-fluid">
                            <?php
                            // get shipping info
                            $shipping = mysqli_query($con, "SELECT * FROM shipping WHERE id = $shipping_type")->fetch_assoc();

                            ?>
                            <div class="row mt-3 mb-4 align-items-center">
                                <div class="col-md">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <p class="my-1 fs-5">Payment Method</p>
                                        </div>
                                        <div class="col-auto">
                                            <?php
                                            $payment_method = mysqli_query($con, "SELECT * FROM payment_method WHERE method_code = 1")->fetch_assoc();
                                            ?>
                                            <p class="my-1 text-orange" id="payment-method-txt"><?php echo $payment_method['description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm text-end">
                                    <a href="#payment-modal" data-bs-toggle="modal" class=" link-primary">CHANGE</a>
                                </div>
                            </div>
                            <hr>
                            <p class="text-black-50 mt-3">Shipping</p>
                            <div class="row">
                                <div class="col">
                                    <p class="my-1">
                                        <?php echo $shipping['description'] ?> <i class=" bx bxs-truck text-orange"></i>
                                    </p>
                                </div>
                                <div class="col-md">
                                    <div class="row mt-4">
                                        <div class="col">
                                            <p class="my-1 fw-light">Subtotal</p>
                                        </div>
                                        <div class="col text-end">
                                            <p class="my-1"><strong>₱</strong> <?php echo number_format($subtotal) ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="my-1 fw-light">Shipping Fee</p>
                                        </div>
                                        <div class="col text-end">
                                            <p class="my-1"><strong>₱</strong> <?php echo number_format($shipping['price']) ?></p>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <p class="my-1 fw-">Total</p>
                                        </div>
                                        <div class="col text-end">
                                            <p class="my-1 text-orange fs-5"><strong>₱</strong><?php echo number_format($subtotal + $shipping['price']) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- checkout form -->
                            <div class="mt-5">
                                <form action="checkout.php" method="post">
                                    <input type="hidden" name="payment_method" id="payment-method" value="1">
                                    <input type="hidden" name="shipping_type" value="<?php echo $shipping['id'] ?>">

                                    <div class="text-end">
                                        <button class="btn btn-orange rounded-1 btn-lg" type="submit">Place Order</button>
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
    <?php include './includes/checkout-modal.php' ?>
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

        $("#address-modal").on("show.bs.modal", function(e) {
            showLoading();
            $.ajax({
                url: "get-shipping-address.php",
                method: "post",
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    hideLoading();
                    if (res.num_rows > 0) {
                        $("#add-fullname").val(res.shipping_address.fullname)
                        $("#add-phone").val(res.shipping_address.phone)

                        $("#add-region").find('option').filter((i, option) => $(option).val() == res.shipping_address.region_code).attr("selected", true)

                        //province
                        // $("#add-province").ph_locations('fetch_list', [{
                        //     "region_code": res.shipping_address.region_code
                        // }]);
                        $("#add-province").find('option').filter((i, option) => $(option).val() == res.shipping_address.province_code).attr("selected", true);

                        //city
                        // $("#add-city").ph_locations('fetch_list', [{
                        //     "province_code": res.shipping_address.province_code
                        // }]);
                        $("#add-city").find('option').filter((i, option) => $(option).val() == res.shipping_address.city_code).attr("selected", true);

                        //barangay
                        // $("#add-barangay").ph_locations('fetch_list', [{
                        //     "city_code": res.shipping_address.city_code
                        // }]);
                        $("#add-barangay").find('option').filter((i, option) => $(option).val() == res.shipping_address.barangay_code).attr("selected", true);
                        $("#add-street-name").val(res.shipping_address.street_name)
                        $("#add-zip-code").val(res.shipping_address.zip_code)
                        $("#add-house-no").val(res.shipping_address.house_no)
                    }
                }
            })
        });

        $(function() {
            $("#add-region").ph_locations({
                'location_type': 'regions'
            });
            $("#add-province").ph_locations({
                'location_type': 'provinces'
            });
            $("#add-city").ph_locations({
                'location_type': 'cities'
            });
            $("#add-barangay").ph_locations({
                'location_type': 'barangays'
            });
            $('#add-region').ph_locations('fetch_list');
            $('#add-province').ph_locations('fetch_list');
            $('#add-city').ph_locations('fetch_list');
            $('#add-barangay').ph_locations('fetch_list');

            $('#add-region').on("change", function(e) {
                var code = $(this).val();
                $("#add-province").ph_locations('fetch_list', [{
                    "region_code": code
                }]);

                $("#region-code").val(code)
            })
            $('#add-province').on("change", function(e) {
                var code = $(this).val();
                $("#add-city").ph_locations('fetch_list', [{
                    "province_code": code
                }]);
                $("#province-code").val(code)

            })
            $('#add-city').on("change", function(e) {
                var code = $(this).val();
                $("#add-barangay").ph_locations('fetch_list', [{
                    "city_code": code
                }]);
                $("#city-code").val(code)
            })
            $('#add-barangay').on("change", function(e) {
                var code = $(this).val();
                $("#barangay-code").val(code)
            })

        })

        $("#add-address-form").on("submit", function(e) {
            e.preventDefault();
            const fullname = $("#add-fullname").val();
            const phone = $("#add-phone").val();
            const region = $("#add-region").find('option:selected').text();
            const province = $("#add-province").find('option:selected').text();
            const city = $("#add-city").find('option:selected').text();
            const barangay = $("#add-barangay").find('option:selected').text();
            const street_name = $("#add-street-name").val();
            const house_no = $("#add-house-no").val();
            const zip_code = $("#add-zip-code").val();
            const barangay_code = $("#barangay-code").val();
            const region_code = $("#region-code").val();
            const province_code = $("#province-code").val();
            const city_code = $("#city-code").val();
            showLoading();

            $.ajax({
                url: "add-shipping-address.php",
                method: "post",
                data: {
                    fullname,
                    phone,
                    region,
                    province,
                    city,
                    barangay,
                    street_name,
                    house_no,
                    zip_code,
                    region_code,
                    barangay_code,
                    province_code,
                    city_code
                },
                dataType: 'json',
                success: function(res) {
                    console.log(res)
                    hideLoading();
                    $("#address-modal").modal('hide')
                    $("#address-name").html(res.fullname)
                    $("#address-text").html(`${res.region} ${res.province} ${res.city} ${res.barangay}`)
                },
                error: function(err) {
                    hideLoading();
                    console.log('error in adding address: ', err)
                }
            })

        })
    </script>
</body>

</html>