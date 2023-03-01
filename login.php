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
                        <form action="login_submit.php" method="post">
                            <?php 
                                if(isset($_GET['source'])){
                                    ?>
                                    <input type="hidden" name="source" value="<?php echo $_GET['source'] ?>">
                                    <?php
                                }
                            ?>
                            <p class="mt-1 mb-5 fs-3 ">Sign In</p>
                            <?php 
                                if(Session::hasSession("error")){
                                    ?>
                                    <div class="alert alert-danger py-2">
                                        <small><i class="bx bx-info-circle"></i> <?php echo Session::getError() ?></small>
                                    </div>
                                    <?php
                                }
                            ?>
                            <div class="mb-3">
                                <label for="" class="form-label">Username:</label>
                                <input type="text" class="form-control" name="username">
                            </div>
                            <div class="mb-4">
                                <label for="" class="form-label">Password:</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-orange" id="submit-btn" type="submit" name="submit">Sign In</button>
                            </div>
                            <p class="mt-3 text-center">Dont Have an account yet? <a href="signup.php">Create here!</a></p>
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
            if(validated === true){
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
    </script>
</body>

</html>