<?php include '../conn/conn.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "products";
        include './includes/sidebar.php'
        ?>
        <main class="main-container">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-package bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Products</p>
                    </div>
                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-body">
                            <?php 
                                // category
                                if(!isset($_GET['category'])){
                                    $query = mysqli_query($con,"SELECT * FROM categories ORDER BY id ASC LIMIT 1");
                                }else{
                                    $category_id = $_GET['category'];
                                    $query = mysqli_query($con,"SELECT * FROM categories WHERE id = $category_id");
                                }

                                $category = $query->fetch_assoc();
                            ?>
                            

                            <div class="text-start">
                                <a href="#status-modal" data-bs-toggle="modal" class="link-secondary fw-bold text-decoration-none">
                                    <i class="bx bx-chevron-down"></i>
                                    <?php echo $category['category_name'] ?>
                                    <i class="bx bx-filter"></i>
                                </a>
                            </div>
                            <div class="alert alert-info mb-4 mt-2 py-2">
                                <small>Showing products from <strong><?php echo $category['category_name'] ?></strong> category.</small>
                            </div>
                            <table class="table" id="table">
                                <thead>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $category_id = $category['id'];
                                        $query = mysqli_query($con,"SELECT * FROM products WHERE category_id = $category_id");
                                        while($row = $query->fetch_assoc()){
                                            ?>
                                               <tr>
                                                <td><?php echo $row['product_name'] ?></td>
                                                <td><?php echo $category['category_name'] ?></td>
                                                <td><?php echo $row['price'] ?></td>
                                                <td><?php echo $row['stock'] ?></td>
                                                <td>
                                                    <a href="#manage-modal" data-bs-toggle="modal" class="link-dark">
                                                        <i class="bx bx-eye"></i>
                                                    </a>
                                                </td>
                                               </tr> 
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
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