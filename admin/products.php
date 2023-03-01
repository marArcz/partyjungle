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
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
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
                                                    <a href="manage-product.php?id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>"  class="link-dark">
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
        var photos = [];
        var editPhotos = [];
        var photoCounter = 0;
        var editPhotoCounter = 0;
        var mainPhoto = "";
        var editMainPhoto = "";

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
                    editPhotos = [];
                    editPhotoCounter = 0;
                    // editPhotos = res.product_photos.map((val, index) => {
                    //     return {
                    //     }
                    // })
                }
            })
        })

        $("#add-photo-input").on("change", function(e) {
            let files = e.target.files
            for (let file of files) {
                let photo = {
                    index: photoCounter,
                    file
                }
                photos.push(photo);

                let item = `<div class="item">
                                        <img src="${URL.createObjectURL(file)}" class="img-thumbnail" alt="">
                                        <button data-index="${photoCounter}" class="btn btn-sm btn-light text-dark border add-remove-photo remove-btn" type="button">
                                            <i class="bx bx-x"></i>
                                        </button>
                                    </div>`
                $("#add-photos-row").append(item)

                photoCounter++;
            }
            console.log('photos: ', photos)
            $(".add-remove-photo").on("click", function(e) {
                let index = $(this).data("index");
                let newPhotos = photos.filter((val, i) => val.index != index);
                photos = newPhotos;

                console.log("photos after deletion: ", photos)

                $(this).parent().remove()

            })
        })

        $("#file-input").on("change", function(e) {
            mainPhoto = e.target.files[0]
            console.log("photo: ", mainPhoto)
        })

        $("#add-product-form").on("submit", function(e) {
            e.preventDefault();
            let val = $("#file-input").val();
            let name = $("#add-name").val()
            let price = $("#add-price").val()
            let category_id = $("#add-category").val()
            let stocks = $("#add-stocks").val()
            let description = $("#add-description").val()

            const formData = new FormData();
            formData.append('photo', mainPhoto);
            formData.append("name", name)
            formData.append("price", price)
            formData.append("category_id", category_id)
            formData.append("stocks", stocks)
            formData.append("description", description)
            for (let photo of photos) {
                formData.append("product_photos[]", photo.file)
            }
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            showLoading();
            axios.post("add-product.php", formData, config)
                .then(res => {
                    window.location.href = `add-success-session.php?route=products.php&message=Successfully added!`
                    console.log('res: ', res)
                })
                .catch(err => console.log('error: ', err))
        })

        $("#edit-photo-input").on("change", function(e) {
            let files = e.target.files
            for (let file of files) {
                let photo = {
                    index: editPhotoCounter,
                    file
                }
                editPhotos.push(photo);

                let item = `<div class="item">
                                        <img src="${URL.createObjectURL(file)}" class="img-thumbnail" alt="">
                                        <button data-index="${editPhotoCounter}" class="btn btn-sm btn-light text-dark border edit-remove-photo remove-btn" type="button">
                                            <i class="bx bx-x"></i>
                                        </button>
                                    </div>`
                $("#edit-photos-row").append(item)

                editPhotoCounter++;
            }
            console.log('edit photos: ', editPhotos)
            $(".edit-remove-photo").on("click", function(e) {
                let index = $(this).data("index");
                let newPhotos = editPhotos.filter((val, i) => val.index != index);
                editPhotos = newPhotos;

                console.log("photos after deletion: ", editPhotos)

                $(this).parent().remove()

            })
        })
    </script>
</body>

</html>