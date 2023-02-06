<?php include './conn/conn.php' ?>
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
    <div class="top-header bg-light">
        <div class="container d-flex py-2">
            <p class="my-1"><i class="bx bx-phone"></i> Call us: 0965 753 4909</p>
            <p class="my-1 ms-auto">Open hour: 8:00 am - 5:00 pm</p>
        </div>
    </div>
    <div class="secondary-header">
        <div class="container d-flex py-3">
            <p class="my-1"><i class="bx bx-sm bxs-envelope"></i> partyjungle@gmail.com</p>
            <img class="logo ms-auto me-auto" src="assets/images/logo1.png" alt="">
            <div class="">
                <ul class="nav align-items-center">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bx bx-sm text-dark bxs-shopping-bag"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-sm btn-orange rounded-pill text-white px-4">
                            Log out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-navbar navbar bg-yellow">
        <div class="container align-items-center">
            <ul class="nav">
                <li class="nav-item active">
                    <a href="#" class="nav-link">HOME</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">PRODUCTS</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">CART</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">STATUS</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">CONTACT</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">ABOUT</a>
                </li>
            </ul>
            <div class="ms-auto">
                <input type="text" placeholder="Search" class="px-3 search-input form-control form-control-sm rounded-pill">
            </div>
        </div>
    </div>

    <main class="main">
        <section class="hero-main">
            <div class="container">
                <div class="row mt-5 align-items-center">
                    <div class="col-md">
                        <h1 class="text-yellow">Party Jungle</h1>
                        <h1 class="text-orange">Party Needs & Toys</h1>
                        <h3 class="mt-5">We offer retail and wholesale of super affordable party needs, toys, ride on cars.</h3>
                        <a href="#" class="btn btn-primary px-5 py-2 mt-4 rounded-pill">SHOP NOW</a>
                    </div>
                    <div class="col-md-4">
                        <img src="./assets/images/ban_img1.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="categories-container mt-4">
            <div class="row gx-0">
                <?php
                $query = mysqli_query($con, "SELECT * FROM categories");
                $i = 1;
                while ($row = $query->fetch_assoc()) {
                ?>
                    <div class="col text-center">
                        <div class="card border-0 rounded-0 <?php echo $i % 2 == 0 ? "bg-yellow" : "bg-orange" ?>">
                            <div class="card-body">
                                <p class="text-light my-1">
                                    <?php echo $row['category_name'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
                    $i++;
                }
                ?>
            </div>
        </section>
    </main>
</body>

</html>