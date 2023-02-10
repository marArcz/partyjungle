<?php 
    include '../conn/conn.php';
    include './includes/Session.php';
    //check an admin account already exists
    $query = mysqli_query($con,"SELECT * FROM admin");
    if($query->num_rows == 0){
        Session::redirectTo("signup.php");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Jungle | Admin Sign In</title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-yellow">
    <div class="container login-container">
        <div class="row justify-content-center align-items-center login-form">
            <div class="col-lg-4 col-sm-9">
                <div class="card rounded-3 shadow-sm border-0 ">
                    <div class="card-body py-5 px-4">
                        <div class="text-center mb-4">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-sm-8 ">
                                    <img src="../assets/images/ban_img1.png" alt="party jungle logo" class="img-fluid">
                                </div>
                            </div>
                            <p class="mt-4 fw-bold fs-5">Party Jungle | Administrator</p>
                        </div>

                        <form action="login_submit.php" method="post">
                            <div class="mb-4">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" required class="form-control">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" required class="form-control">
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-orange" type="submit" name="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>