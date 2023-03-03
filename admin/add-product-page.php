<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | Admin </title>
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
                        <a href="products.php" class=" text-decoration-none">
                            <span class="card-icon card-icon-sm me-2 shadow-sm">
                                <i class="bx bx-arrow-back bx-sm"></i>
                            </span>
                        </a>
                        <p class="fs-4 fw-bold my-0"> Add Product</p>
                    </div>
                    <form action="add-product.php" id="add-product-form" enctype="multipart/form-data" method="post">
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-4">
                                <p class="form-text">Product Details</p>
                                <div class="row gy-3">
                                    <div class="col-md-3 text-center">
                                        <img required src="../assets/data/default.png" id="image-preview" class="img-fluid mb-1" alt="">
                                        <div class="text-center">
                                            <!-- <p class=" text-secondary mt-1 mb-2">
                                            <small>Main Photo</small>
                                        </p> -->
                                            <div class="d-grid">
                                                <button class="btn btn-sm mt-2 btn-orange file-input-toggler" data-target="#file-input" type="button">Upload</button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md">
                                        <input type="file" data-img-preview="#image-preview" name="photo" class="d-none" id="file-input">
                                        <div class="mb-3">
                                            <label for="" class="form-label">Product Name:</label>
                                            <input required type="text" id="add-name" class="form-control" name="name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Category:</label>
                                            <select required name="category_id" id="add-category" class="form-select">
                                                <option value="">Select one</option>
                                                <?php
                                                $query = mysqli_query($con, "SELECT * FROM categories");
                                                while ($row = $query->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $row['id'] ?>">
                                                        <?php echo $row['category_name'] ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="" class="form-label">Price:</label>
                                            <input required type="number" id="add-price" name="price" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Stocks:</label>
                                            <input required type="number" id="add-stocks" name="stocks" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Product Description:</label>
                                            <textarea name="description" id="add-description" class="form-control" rows="5"></textarea>
                                        </div>
                                        <div class="mt-4 text-start mb-3">
                                            <div class="card border">
                                                <div class="card-body">
                                                    <input type="file" multiple id="add-photo-input" class="d-none">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <p class="form-text my-0">Additional Photos</p>
                                                        <div class="ms-auto">
                                                            <button class="btn btn-brown btn-sm file-input-toggler" data-target="#add-photo-input" type="button">
                                                                <small><i class="bx bx-plus text-light"></i></small>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="photos-row" id="add-photos-row">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" name="is_featured" id="featured">
                                                <label class="form-check-label text-orange" for="featured">
                                                    Feature this product
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="text-end mt-3">
                            <a href="" class="btn btn-light border-2 border">Cancel</a>
                            <button class="btn btn-orange" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/scripts.php' ?>
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
                                        <img src="${URL.createObjectURL(file)}" class="border border-2 border shadow-sm" width="60" height="60" alt="">
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
                    // if (res.data.category == "Balloons") {
                    //     window.location.href = `manage-product.php?product_id=${res.data.product_id}`
                    // } else {
                    //     window.location.href = `add-success-session.php?route=products.php&message=Successfully added!`

                    // }
                    window.location.href = `manage-product.php?product_id=${res.data.product_id}`

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


        $("#add-category").on('change', function(e) {

        })
    </script>
</body>

</html>