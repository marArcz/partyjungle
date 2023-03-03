<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>

<?php
// get product
$product_id = $_GET['product_id'];
$product = mysqli_query($con, "SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
$tab = isset($_GET['tab']) ? $_GET['tab'] : "Details";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['product_name'] ?> | Admin </title>
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
                        <a href="products.php" class="text-decoration-none">
                            <span class="card-icon card-icon-sm me-2 shadow-sm">
                                <i class="bx bx-arrow-back bx-sm"></i>
                            </span>
                        </a>
                        <p class="fs-4 fw-bold my-0"> <?php echo $product['product_name'] ?></p>
                    </div>
                    <hr>

                    <div class="card border-0 shadow-sm rounded-0">
                        <div class="card-body">
                            <div class="mb-3">
                                <ul class="nav custom-nav border">
                                    <li class="nav-item <?php echo $tab == "Details" ? 'active' : '' ?>">
                                        <a href="manage-product.php?product_id=<?php echo $product_id ?>&tab=Details" class="link-dark nav-link text-decoration-none">
                                            <small>Details</small>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo $tab == "Variations" ? 'active' : '' ?>">
                                        <a href="manage-product.php?product_id=<?php echo $product_id ?>&tab=Variations" class="link-dark nav-link text-decoration-none">
                                            <small>Variations</small>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- details tab -->
                            <div class="tab <?php echo $tab == "Details" ? '' : 'd-none' ?>">
                                <div class="text-end mb-3">
                                    <a href="delete-product.php?id=<?php echo $_GET['product_id'] ?>" class="btn btn-sm btn-danger delete-product"><i class="bx bx-trash"></i></a>
                                </div>
                                <form action="edit-product.php" method="post" enctype="multipart/form-data">
                                    <!-- GET PRODUCT -->
                                    <?php
                                    // get product
                                    $product_id = $_GET['product_id'];
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
                                            <div class="my-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" <?php echo $product['is_featured'] == 1 ? "checked" : "" ?> type="checkbox" value="1" name="is_featured" id="featured">
                                                    <label class="form-check-label text-orange" for="featured">
                                                        Feature this product
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="text-end mb-4">
                                                <button class="btn btn-orange" type="submit">Save Changes</button>
                                            </div>

                                            <div class="card border shadow-sm my-3">
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
                                                                    <img src="../<?php echo $photo_row['photo'] ?>" width="80" height="80" class="border-light border-3 border shadow" alt="">
                                                                    <button type="button" data-id="<?php echo $photo_row['id'] ?>" class="btn btn-light btn-sm border text-dark remove-btn">
                                                                        <i class="bx bx-x"></i>
                                                                    </button>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>

                            </div>
                            <!-- variations tab -->
                            <div class="tab <?php echo $tab == "Variations" ? '' : 'd-none' ?>">
                                <div class="d-flex flex-wrap align-items-baseline">
                                    <a href="add-variation-row.php?product_id=<?php echo $product_id ?>" class="btn btn-light btn-sm fw-bold text-dark p-2 rounded mb-3 border <?php echo $product['is_variation_enabled'] == 0 ? 'disabled' : '' ?>">
                                        <small>Add Variation</small>
                                    </a>
                                    <div class="form-check form-switch ms-auto">
                                        <input class="form-check-input" <?php echo $product['is_variation_enabled'] == 1 ? "checked" : "" ?> type="checkbox" role="switch" id="variation-switch">
                                        <label class="form-check-label" for="variation-switch">Enable Variations</label>
                                    </div>
                                </div>
                                <?php
                                if ($product['is_variation_enabled'] == 0) {
                                ?>
                                    <div class="alert alert-warning ">
                                        <small><i class=" bx bx-info-circle"></i> Products variations is disabled.</small>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered align-middle text-secondary" id="variation-table">
                                        <thead>
                                            <?php
                                            // get product variations
                                            $query = mysqli_query($con, "SELECT * FROM properties WHERE product_id = $product_id");
                                            while ($row = $query->fetch_assoc()) {
                                                // properties
                                            ?>
                                                <th class="<?php echo $row['property_name'] != 'Image' && $row['property_name'] != 'Price' ? 'text-orange' : '' ?>">

                                                    <?php
                                                    if ($row['property_name'] != "Image" && $row['property_name'] != "Price") {
                                                    ?>
                                                        <a href="delete-property.php?id=<?php echo $row['id'] ?>&product_id=<?php echo $product_id ?>" class="delete-property link-orange text-decoration-none">
                                                            <small><?php echo $row['property_name'] ?></small>
                                                        </a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <small><?php echo $row['property_name'] ?></small>
                                                    <?php
                                                    }
                                                    ?>
                                                </th>
                                            <?php
                                            }
                                            ?>
                                            <!-- <th><small>Image</small></th>
                                            <th><small>Price</small></th> -->
                                            <th class="text-end">
                                                <?php
                                                if ($product['is_variation_enabled'] == 1) {
                                                ?>
                                                    <a href="#property-modal" data-bs-toggle="modal" class="link-primary text-decoration-none">
                                                        <small> <i class="bx bx-plus"></i> Add property</small>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class=" text-secondary">
                                                        <small> <i class="bx bx-plus"></i> Add property</small>
                                                    </span>
                                                <?php
                                                }
                                                ?>
                                            </th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // get variations
                                            $properties = [];
                                            $get_variations = mysqli_query($con, "SELECT * FROM variations WHERE product_id = $product_id");
                                            while ($variation = $get_variations->fetch_assoc()) {
                                            ?>
                                                <tr data-id="<?php echo $variation['id'] ?>" id="table-row-<?php echo $variation['id'] ?>">
                                                    <?php
                                                    // get properties
                                                    $variation_id = $variation['id'];
                                                    $get_properties = mysqli_query($con, "SELECT * FROM properties WHERE product_id = $product_id");
                                                    $values = [];
                                                    // properties
                                                    while ($property = $get_properties->fetch_assoc()) {
                                                        // get property value
                                                        $property_id = $property['id'];
                                                        $get_value = mysqli_query($con, "SELECT value FROM property_values WHERE property_id = $property_id AND variation_id = $variation_id");
                                                        if ($get_value->num_rows > 0) {
                                                            $value = $get_value->fetch_array()[0];
                                                        } else {
                                                            $value = "";
                                                        }
                                                    ?>
                                                        <td>
                                                            <?php
                                                            if ($property['property_name'] == "Image") {
                                                            ?>
                                                                <div class="d-flex flex-wrap">
                                                                    <img data-default="<?php echo $value ?>" id="image-preview-<?php echo $variation['id'] ?>" src="../<?php echo $value ?>" width="40" height="40" alt="" class="me-4 my-1 view-photo">
                                                                    <div class="image-control d-none my-1">
                                                                        <input type="file" data-img-preview="#image-preview-<?php echo $variation['id'] ?>" class="d-none file-input-row" data-row="#table-row-<?php echo $variation['id'] ?>" id="file-input-<?php echo $variation['id'] ?>">
                                                                        <button data-target="#file-input-<?php echo $variation['id'] ?>" class="btn btn-sm file-input-toggler btn-light border text-success fw-bold">
                                                                            <i class='bx bx-upload'></i>
                                                                        </button>
                                                                        <button data-row="#table-row-<?php echo $variation['id'] ?>" class="btn btn-sm btn-light border reset-btn text-dark fw-bold">
                                                                            <i class="bx bx-reset"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            } else if ($property['property_name'] == "Price") {
                                                            ?>
                                                                <span class="value-text">₱<?php echo $value ?></span>
                                                                <div class="input-group inputs d-none">
                                                                    <span class="input-group-text bg-white text-secondary" id="basic-addon1">₱</span>
                                                                    <input data-default="<?php echo $value ?>" data-name="<?php echo $property['property_name'] ?>" type="number" class="form-control value-input " value="<?php echo $value ?>" placeholder="<?php echo $property['property_name'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                                                                </div>

                                                            <?php
                                                            } else {
                                                            ?>
                                                                <span class="value-text "><?php echo $value ?></span>
                                                                <div class=" inputs d-none">
                                                                    <input data-default="<?php echo $value ?>" data-name="<?php echo $property['property_name'] ?>" type="text" class="form-control value-input" value="<?php echo $value ?>" placeholder="<?php echo $property['property_name'] ?>" aria-label="Username" aria-describedby="basic-addon1">
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td class="text-end">
                                                        <div class="edit-btn-group">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Default button group">
                                                                <button <?php echo $product['is_variation_enabled'] == 0 ? 'disabled' : '' ?> data-row="#table-row-<?php echo $variation['id'] ?>" type="button" class="edit-btn btn btn-outline-dark">
                                                                    <i class='bx bx-pencil'></i>
                                                                </button>
                                                                <button <?php echo $product['is_variation_enabled'] == 0 ? 'disabled' : '' ?> data-row="#table-row-<?php echo $variation['id'] ?>" type="button" class="delete-btn btn btn-outline-dark">
                                                                    <i class='bx bx-trash'></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="save-btn-group d-none">
                                                            <button <?php echo $product['is_variation_enabled'] == 0 ? 'disabled' : '' ?> class="btn my-1 btn-light border cancel-btn btn-sm" data-row="#table-row-<?php echo $variation['id'] ?>" type="button">
                                                                <small>Cancel</small>
                                                            </button>
                                                            <button <?php echo $product['is_variation_enabled'] == 0 ? 'disabled' : '' ?> class="btn my-1 btn-brown save-btn btn-sm" data-row="#table-row-<?php echo $variation['id'] ?>" type="button">
                                                                <small class="text">Save</small>
                                                                <span class="d-none spinner-border mx-2 spinner-border-sm" role="status" aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            <!-- <tr>
                                                <td>
                                                    <img src="../<?php echo $product['photo'] ?>" width="40" height="40" alt="">
                                                </td>
                                                <td>
                                                    <small>P1500</small>
                                                </td>
                                                <td class="text-end">
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Default button group">
                                                        <button type="button" class="btn btn-outline-dark">
                                                            <i class='bx bx-pencil'></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-dark">
                                                            <i class='bx bx-trash'></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/modals/photo-modal.php' ?>
    <?php include './includes/modals/variation-modals.php' ?>
    <?php include './includes/scripts.php' ?>
    <?php include './includes/alerts.php' ?>

    <script>
        $("#variation-switch").on("change", function(e) {
            console.log('enabled: ', $(this).is(":checked"));

            let status = $(this).is(":checked") ? 1 : 0
            let product_id = "<?php echo $product_id ?>"
            window.location.href = `update-variation-status.php?status=${status}&product_id=${product_id}`;

        })

        var image = null;
        // add property form
        $("#add-property-form").on("submit", function(e) {
            e.preventDefault();
            const property_name = $("#add-property").val();
            const product_id = $("#input-id").val();
            showLoading();
            $.ajax({
                url: "add-property.php",
                method: "POST",
                data: {
                    property_name,
                    product_id
                },
                dataType: "json",
                success: function(res) {
                    hideLoading();
                    console.log('res: ', res)
                    const property = res.property;
                    const lastTableHead = $("#variation-table").find("thead th:last")

                }
            })
        })

        $(".edit-btn").on("click", function(e) {
            let rowId = $(this).data('row');
            $(rowId).find(".inputs").removeClass("d-none")
            $(rowId).find(".value-text").addClass("d-none")
            $(rowId).find(".edit-btn-group").addClass("d-none")
            $(rowId).find(".save-btn-group").removeClass("d-none")
            $(rowId).find(".image-control").removeClass("d-none")

        })

        $(".save-btn").on("click", function(e) {
            let rowId = $(this).data('row');
            const row = $(rowId);
            const formData = new FormData();
            formData.append("variation_id", row.data("id"));
            if (image !== null) {
                formData.append("image", image);
            } else {
                let img_src = row.find('img').data("default");
                formData.append("img_src", img_src)
            }
            row.find(".value-input").each((index, input) => {
                let name = $(input).data('name')
                let val = $(input).val();

                formData.append(name, val);
            })
            formData.append("product_id", "<?php echo $product_id ?>")
            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            }
            // showLoading();
            const btn = $(this);
            btn.find(".text").addClass('d-none')
            btn.find(".spinner").removeClass('d-none')
            axios.post('add-variation.php', formData, config)
                .then(res => {
                    console.log('res: ', res)
                    // hideLoading();
                    btn.find(".text").removeClass('d-none')
                    btn.find(".spinner").addClass('d-none')
                    //data
                    let datas = res.data.properties;
                    let img = "";
                    for (let data of datas) {
                        if (data.property_name == "Image") {
                            row.find("img").data("default", data.value).attr('src', '../' + data.value);
                        } else {
                            let inputElem = row.find(".value-input").filter((i, elem) => $(elem).data('name') == data.property_name)
                            inputElem.data('default', data.value)
                            if (data.property_name == "Price") {
                                inputElem.parent().siblings(".value-text").html("₱" + data.value);

                            } else {
                                inputElem.parent().siblings(".value-text").html(data.value);
                            }
                        }
                    }
                    row.find(".inputs").addClass("d-none")
                    row.find(".value-text").removeClass("d-none")
                    row.find(".edit-btn-group").removeClass("d-none")
                    row.find(".save-btn-group").addClass("d-none")
                    $(rowId).find(".image-control").addClass("d-none")

                })

        })

        function onFileSelect(e) {
            let file = e.target.files[0];
            image = file;
            console.log('image: ', image)
        }
        $(".file-input-row").on("change", onFileSelect)
        $(".cancel-btn").on("click", function(e) {
            let rowId = $(this).data('row');
            $(rowId).find(".inputs").addClass("d-none")
            $(rowId).find(".value-text").removeClass("d-none")
            $(rowId).find(".edit-btn-group").removeClass("d-none")
            $(rowId).find(".save-btn-group").addClass("d-none")
            $(rowId).find(".image-control").addClass("d-none")

            // return default value
            $(rowId).find('input').each((index, input) => {
                let val = $(input).data('default');
                $(input).val(val);
            })
        })

        $(".delete-btn").on("click", function(e) {
            let rowId = $(this).data("row");
            const row = $(rowId);
            const variation_id = row.data('id');

            showLoading();

            $.ajax({
                url: "delete-variation.php",
                method: "POST",
                data: {
                    variation_id
                },
                dataType: 'json',
                success: function(res) {
                    console.log('delete: ', res);
                    hideLoading();
                    row.remove();
                }
            })
        })

        $(".delete-property").on("click", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");

            Notiflix.Confirm.show(
                'Confirm',
                'Delete this property?',
                'Yes',
                'No',
                function okCb() {
                    window.location.href = url;
                },
                function cancelCb() {}, {},
            );
        })
        $(".reset-btn").on('click', function(e) {
            let rowId = $(this).data("row");
            const row = $(rowId);

            row.find(".file-input-row").val("");
            let val = row.find("img").data('default');
            row.find("img").attr('src', '../' + val)
            image = null;

        })


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
                    for (let photoRow of res.data.photos) {
                        let item = `<div class="item">
                                        <img src="../${photoRow.photo}" width="80" height="80" class="border-light border-3 border shadow" alt="">
                                        <button data-id="${photoRow.id}" class="btn btn-sm btn-light text-dark border remove-btn" type="button">
                                            <i class="bx bx-x"></i>
                                        </button>
                                    </div>`
                        $("#edit-photos-row").append(item)
                    }
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
            console.log('edit photos: ', editPhotos)



        })

        $(".delete-product").on("click", function(e) {
            e.preventDefault();
            let url = $(this).attr("href");

            Notiflix.Confirm.show(
                'Confirm',
                'Delete this product?',
                'Yes',
                'No',
                function okCb() {
                    window.location.href = url;
                },
                function cancelCb() {}, {},
            );
        })
    </script>
</body>

</html>