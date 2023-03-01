<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "dashboard";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <a href="products.php" class="text-decoration-none">
                            <span class="card-icon card-icon-sm me-2 shadow-sm">
                                <i class="bx bx-arrow-back bx-sm"></i>
                            </span>
                        </a>
                        <p class="fs-4 fw-bold my-0"> Manage Product</p>
                    </div>
                    <div class="card shadow-sm border-0">
                        <div class="card-body pt-4">
                            <div class="text-end mb-3">
                                <a href="delete-product.php?id=<?php echo $_GET['id'] ?>" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                            </div>
                            <form action="edit-product.php" method="post" enctype="multipart/form-data">
                                <!-- GET PRODUCT -->
                                <?php
                                // get product
                                $product_id = $_GET['id'];
                                $product = mysqli_query($con, "SELECT products.*,categories.category_name FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $product_id")->fetch_assoc();

                                ?>
                                <input type="hidden" name="id" value="<?php echo $product_id ?>">
                                <div class="row gy-3">
                                    <div class="col-md-4 text-center">
                                        <img src="../<?php echo $product['photo'] ?>" id="edit-image-preview" class="img-fluid mb-1 img-thumbnail" alt="">
                                        <div class="text-center">
                                            <p class=" text-secondary mt-1 mb-2">
                                                <small>Main Photo</small>
                                            </p>
                                            <button class="btn btn-orange file-input-toggler" data-target="#edit-file-input" type="button">Change Image</button>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <input type="file" data-img-preview="#edit-image-preview" name="photo" class="d-none" id="edit-file-input">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Product Name:</label>
                                            <input type="text" required class="form-control" name="name" value="<?php echo $product['product_name'] ?>" id="edit-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Category:</label>
                                            <select required name="category_id" class="form-select" id="edit-category">
                                                <option value="">Select one</option>
                                                <?php
                                                $query = mysqli_query($con, "SELECT * FROM categories");
                                                while ($row = $query->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $row['id'] ?>" <?php echo $product['category_id'] == $row['id'] ? 'selected' : '' ?>>
                                                        <?php echo $row['category_name'] ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="" class="form-label">Price:</label>
                                            <input required type="number" name="price" id="edit-price" class="form-control" value="<?php echo $product['price'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Stocks:</label>
                                            <input required type="number" name="stocks" class="form-control" id="edit-stocks" value="<?php echo $product['stocks'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Product Description:</label>
                                            <textarea required name="description" class="form-control" rows="5" id="edit-description"><?php echo $product['description'] ?></textarea>
                                        </div>
                                        <div class="text-end mb-4">
                                            <button class="btn btn-sm btn-orange" type="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm my-3">
                        <div class="card-body">
                            <div class="">
                                <p class="form-text">Product Photos</p>
                                <input type="file" multiple id="edit-photo-input" class="d-none">
                                <div class="text-end mb-3">
                                    <button class="btn btn-brown btn-sm file-input-toggler" data-target="#edit-photo-input" type="button">Add Photo</button>
                                </div>
                                <div class="photos-row" id="edit-photos-row">
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM product_photos WHERE product_id = $product_id");
                                    while ($photo_row = $query->fetch_assoc()) {
                                    ?>
                                        <div class="item">
                                            <img src="../<?php echo $photo_row['photo'] ?>" class=" img-thumbnail" alt="">
                                            <button type="button" data-id="<?php echo $photo_row['id'] ?>" class="btn btn-light btn-sm border text-dark remove-btn">
                                                <i class="bx bx-x"></i>
                                            </button>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <!-- <div class="d-flex mt-4 photos-row mb-3">
                                  
                                </div> -->

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/scripts.php' ?>
    <?php include './includes/alerts.php' ?>
    <script>
        var photos = [];
        var editPhotos = [];
        var photoCounter = 0;
        var editPhotoCounter = 0;
        var mainPhoto = "";
        var editMainPhoto = "";
        $(".remove-btn").on("click", function(e) {
            let id = $(this).data("id");
            const item = $(this).parent();
            showLoading();
            $.ajax({
                url: "remove-photo.php",
                method: "POST",
                data: {
                    id
                },
                dataType: 'json',
                success: (res) => {
                    console.log('res: ', res);
                    hideLoading();
                    item.remove()
                }
            })
        })

        $("#edit-photo-input").on("change", function(e) {
            let files = e.target.files
            const formData = new FormData();
            showLoading();
            for (let file of files) {
                let photo = {
                    index: editPhotoCounter,
                    file
                }
                editPhotos.push(photo);
                formData.append("product_photos[]", file);
                let item = `<div class="item">
                                        <img src="${URL.createObjectURL(file)}" class="img-thumbnail" alt="">
                                        <button data-index="${editPhotoCounter}" class="btn btn-sm btn-light text-dark border remove-btn" type="button">
                                            <i class="bx bx-x"></i>
                                        </button>
                                    </div>`
                $("#edit-photos-row").append(item)
                editPhotoCounter++;
            }
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            formData.append("product_id", "<?php echo $product_id ?>")

            axios.post("add-product-photo.php", formData, config)
                .then(res => {
                    hideLoading();
                    console.log('response: ', res);
                })
            console.log('edit photos: ', editPhotos)

            $(".remove-btn").on("click", function(e) {
                let id = $(this).data("id");
                const item = $(this).parent();
                showLoading();
                $.ajax({
                    url: "remove-photo.php",
                    method: "POST",
                    data: {
                        id
                    },
                    dataType: 'json',
                    success: (res) => {
                        console.log('res: ', res);
                        hideLoading();
                        item.remove()
                    }
                })
            })

        })
    </script>
</body>

</html>