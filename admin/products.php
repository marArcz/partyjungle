<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
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
                    <div class="text-end mb-3">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btn-orange">Add Product </button>
                    </div>
                    <div class="card rounded-4 border-0 shadow-sm">
                        <div class="card-body">
                            <?php
                            // category
                            $category = isset($_GET['category']) ? $_GET['category'] : "All";

                            ?>


                            <div class="text-start">
                                <!-- <a href="#category-modal" data-bs-toggle="modal" class="link-secondary fw-bold text-decoration-none">
                                    <i class="bx bx-chevron-down"></i>
                                    <?php echo $category ?>
                                    <i class="bx bx-filter"></i>
                                </a> -->
                                <div class="dropdown">
                                    <!-- <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Dropdown button
                                    </button> -->
                                    <a role="button" aria-expanded="false" data-bs-toggle="dropdown" class="link-secondary fw-bold text-decoration-none">
                                        <i class="bx bx-chevron-down"></i>
                                        <?php echo $category ?>
                                        <i class="bx bx-filter"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="products.php?category=All">All</a>
                                        </li>
                                        <?php
                                        $query = mysqli_query($con, "SELECT * FROM categories");
                                        while ($row = $query->fetch_assoc()) {
                                        ?>
                                            <li><a class="dropdown-item" href="products.php?category=<?php echo $row['category_name'] ?>"><?php echo $row['category_name'] ?></a></li>
                                        <?php
                                        }
                                        ?>
                                        <!-- <li><a class="dropdown-item" href="#">Another action</a></li>
                                        <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="alert alert-info mb-4 mt-2 py-2">
                                <?php
                                if (strtolower($category) != "all") {
                                ?>
                                    <small>Showing products from <strong><?php echo $category ?></strong> category.</small>
                                <?php
                                } else {
                                ?>
                                    <small>Showing all products.</small>

                                <?php
                                }
                                ?>
                            </div>
                            <div class="table-responsive-sm">
                                <table class="table" id="table">
                                    <thead>
                                        <th>Photo</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (strtolower($category) == "all") {
                                            $query = mysqli_query($con, "SELECT * FROM products");
                                        } else {
                                            $query = mysqli_query($con, "SELECT * FROM products WHERE category_id IN (SELECT id FROM categories WHERE category_name='$category')");
                                        }
                                        while ($row = $query->fetch_assoc()) {
                                            $cat = mysqli_query($con, "SELECT * FROM categories WHERE id=" . $row['category_id'])->fetch_assoc();
                                        ?>
                                            <tr>
                                                <td><img width="50" src="../<?php echo $row['photo'] ?>" class="img-fluid img-thumbnail" alt=""></td>
                                                <td><?php echo $row['product_name'] ?></td>
                                                <td><?php echo $cat['category_name'] ?></td>
                                                <td><?php echo $row['price'] ?></td>
                                                <td><?php echo $row['stocks'] ?></td>
                                                <td>
                                                    <a href="#manage-modal" data-id="<?php echo $row['id'] ?>" data-bs-toggle="modal" class="link-dark">
                                                        <i class="bx bx-show-alt"></i>
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
                </div>
            </section>
        </main>
    </div>
    <?php include './includes/modals/products-modals.php' ?>
    <?php include './includes/scripts.php' ?>
    <?php include './includes/alerts.php' ?>
    <script>
        $("#manage-modal").on("show.bs.modal", function(e) {
            const id = $(e.relatedTarget).data('id');
            $.ajax({
                url: "get-product.php",
                method: "post",
                data: {
                    id
                },
                dataType: 'json',
                success: function(res) {
                    $('#edit-name').val(res.product_name)
                    $('#edit-category').find("option").removeAttr("selected")
                    $('#edit-category').find("option").filter(function(i, el) {
                        return $(el).val() == res.category_id
                    }).attr('selected', true)
                    $('#edit-price').val(res.price)
                    $('#edit-stocks').val(res.stocks)
                    $('#edit-description').val(res.description)
                    $('#edit-image-preview').attr('src', '../' + res.photo)
                    $(".id-input").val(res.id);

                    $("#delete-btn").attr("href", `delete-product.php?id=${res.id}`);
                }
            })
        })
    </script>
</body>

</html>