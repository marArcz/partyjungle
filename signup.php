<?php include './conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include './includes/header.php' ?>

</head>

<body>
    <?php include './includes/top_header.php' ?>

    <main class="main">
        <section class="signup">
            <div class="container">
                <div class="row my-5 align-items-center">
                    <div class="col-md-4">
                        <div class="row justify-content-center">
                            <div class="col-md-9">
                                <img src="./assets/images/ban_img1.png" alt="" class="img-fluid">
                                <p class="text-secondary text-center">Party Jungle Toys and Party Needs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="signup_submit.php" id="signup-form" method="post">
                            <input type="hidden" name="state" id="state-box">
                            <input type="hidden" name="town" id="town-box">
                            <p class="mt-1 mb-4 fs-4 ">Sign Up</p>
                            <div class="mb-3 row  mt-3 mb-3">
                                <div class="col-md">
                                    <label for="" class="form-label">Firstname:</label>
                                    <input type="text" class="form-control" name="firstname">
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Middlename:</label>
                                    <input type="text" class="form-control" name="middlename">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label for="" class="form-label">Lastname:</label>
                                    <input type="text" class="form-control" name="lastname">
                                </div>
                                <div class="col-md">

                                    <label for="" class="form-label">Home Address:</label>

                                    <input type="text" class="form-control" disabled id="home-address" name="address">
                                    <div class="text-end">
                                        <a href="#" role="button" id="detect-btn" class="my-0 text-end text-uppercase link-orange text-decoration-underlin"><small><i class='bx bx-current-location'></i> Find my location</small></a>
                                    </div>
                                    <!-- <p class="form-text">Click on find my location below to automatically detect your current location.</p> -->

                                </div>
                            </div>
                            <div class="row mb-3 ">
                                <div class="col-md">
                                    <label for="" class="form-label">Contact:</label>
                                    <input type="text" pattern="[0-9]{11}" class="form-control" name="contact">
                                    <p class="form-text fw-light mb-0 mt-1">
                                        Eleven (11) digits phone number.
                                    </p>
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Email Address:</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <p class="form-text text-danger my-1" id="email-exist-label">

                                    </p>
                                </div>
                            </div>
                            <div class="row mb-4 ">
                                <div class="col-md">
                                    <label for="" class="form-label">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username">
                                    <p class="form-text text-danger my-1" id="username-exist-label">

                                    </p>
                                </div>
                                <div class="col-md">
                                    <label for="" class="form-label">Password:</label>
                                    <input autocomplete="true" type="password" class="form-control" pattern=".{8,}" name="password">
                                    <p class="form-text fw-light mb-0 mt-1">
                                        Password must be 8 characters or more.
                                    </p>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-orange" id="submit-btn" type="submit" name="submit">Create Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include './includes/scripts.php' ?>
    <script>
        var validated = false;

        $("#signup-form").on("submit", function(e) {
            if (validated === true) {
                return;
            }
            e.preventDefault();
            e.stopPropagation()
            e.stopImmediatePropagation()
            showLoading();

            const email = $("#email").val();
            const username = $("#username").val();
            $.ajax({
                url: "check_user_exist.php",
                method: "POST",
                data: {
                    email,
                    username
                },
                dataType: "json",
                success: function(res) {
                    console.log('res: ', typeof(res.allowed))
                    if (res.allowed === false) {
                        hideLoading();
                        if (res.email_exists) {
                            $("#email-exist-label").html("Email address is already taken.")
                        }
                        if (res.username_exists) {
                            $("#username-exist-label").html("Username is already taken.")
                        }
                        validated = false;

                    } else {
                        validated = true;
                        $("#submit-btn").trigger('click')

                    }
                }
            })
        })

        $("#detect-btn").on("click", function(e) {
            e.preventDefault();
            getLocation();
        })

        const getLocation = () => {
            $("#home-address").val("...").attr("disabled", true)

            navigator.geolocation.getCurrentPosition(function(position) {

                console.log("Latitude is :", position.coords.latitude);
                console.log("Longitude is :", position.coords.longitude);
                let latitude = position.coords.latitude;
                let longitude = position.coords.longitude
                let url = `https://geocode.maps.co/reverse?lat=${latitude}&lon=${longitude}`
                axios.get(url).then(res => {
                    console.log(res)
                    $("#state-box").val(res.data.address.state)
                    $("#town-box").val(res.data.address.town)
                    $("#home-address").val(res.data.display_name).removeAttr("disabled")
                })
            });
        }
    </script>
</body>

</html>