<?php require './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Jungle | Admin Sign Up</title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-yellow">
    <div class="container login-container">
        <div class="row justify-content-center align-items-center login-form">
            <div class="col-lg-6 col-sm-9">
                <div class="card rounded-3 shadow-sm border-0 ">
                    <div class="card-body py-5 px-4">
                        <div class="text-center mb-4">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 col-sm-8 ">
                                    <img src="../assets/images/ban_img1.png" alt="party jungle logo" class="img-fluid">
                                </div>
                            </div>
                            <p class="mt-4 fw-bold fs-5">Party Jungle | Administrator</p>
                        </div>
                        <?php
                        if (Session::hasSession("success")) :
                        ?>
                            <h5><?php echo Session::getSuccess() ?></h5>
                        <?php
                        endif
                        ?>
                        <p class="form-text mb-4 fw-bold">Create your admin account by filling up this form.</p>
                        <form action="signup_submit.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label for="firstname" class="form-label">Firstname</label>
                                    <input type="text" name="firstname" id="firstname" required class="form-control">
                                </div>
                                <div class="col-md">
                                    <label for="middlename" class="form-label">Middlename</label>
                                    <input type="text" name="middlename" id="middlename" required class="form-control">
                                </div>
                                <div class="col-md">
                                    <label for="lastname" class="form-label">Lastname</label>
                                    <input type="text" name="lastname" id="lastname" required class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md">
                                    <label for="contact" class="form-label">Contact:</label>
                                    <input type="tel" name="contact" placeholder="eg. 09121234456" pattern="[0-9]{11}" id="contact" required class="form-control">
                                </div>
                                <div class="col-md">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" required class="form-control">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" required class="form-control">
                                </div>
                                <div class="col-md">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" required class="form-control">
                                </div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-orange" type="submit" name="submit">Create Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>