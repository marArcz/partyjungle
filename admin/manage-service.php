<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Service | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "services";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state") ? (Session::getSession("partyjungle-sidebar-state", false) == "close" ? 'sidebar-closed' : '') : '' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <a href="services.php" class="link-light text-decoration-none">
                            <span class="card-icon card-icon-sm me-2 shadow-sm">
                                <i class="bx bx-arrow-back bx-sm"></i>
                            </span>
                        </a>
                        <p class="fs-4 fw-bold my-0"> Manage Service</p>
                    </div>
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="services.php" class=" text-decoration-none">Services</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Service</li>
                        </ol>
                    </nav>

                    <div class="card shadow-sm rounded-1 border-0">
                        <div class="card-body">
                            <?php
                            $service_id = $_GET['service_id'];
                            $service = mysqli_query($con, "SELECT * FROM services WHERE id = $service_id")->fetch_assoc();
                            ?>
                            <form action="edit-service.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $service_id ?>">
                                <p class="form-text">Update Service Details</p>
                                <div class="mb-3">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3">
                                            <img src="../<?php echo $service['photo'] ?>" name="photo" class="img-fluid img-thumbnail" id="service-photo" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Photo:</label>
                                    <input type="file" class="form-control file-input" data-img-preview="#service-photo" name="photo">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Service Name:</label>
                                    <input type="text" required class="form-control" name="name" value="<?php echo $service['name'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Description:</label>
                                    <textarea name="description" class="form-control" rows="3"><?php echo $service['description'] ?></textarea>
                                </div>
                                <button class="btn btn-orange btn-sm" type="submit">Save Changes</button>
                            </form>
                            <hr>
                            <p class="form-text">Service options</p>
                            <div class="text-end mb-2">
                                <button class="btn-sm btn-brown btn" type="button" data-bs-target="#add-modal" data-bs-toggle="modal">Add Option</button>
                            </div>
                            <div id="options-row" class="mb-3">
                                <?php
                                $get_options = mysqli_query($con, "SELECT * FROM service_options WHERE service_id = $service_id");
                                while ($row = $get_options->fetch_assoc()) {
                                ?>
                                    <div class="card rounded-1 border mb-3">
                                        <div class="card-body">
                                            <div class="row align-items-end">
                                                <div class="col-sm">
                                                    <label for="" class="form-label">Label:</label>
                                                    <input type="text" disabled value="<?php echo $row['label'] ?>" class="form-control form-control-sm" name="labels[]">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="" class="form-label">Price:</label>
                                                    <input type="number" disabled value="<?php echo $row['price'] ?>" class="form-control form-control-sm" name="prices[]">
                                                </div>
                                                <div class="col-auto">
                                                    <button data-option-label="<?php echo $row['label'] ?>" data-option-price="<?php echo $row['price'] ?>" class="btn btn-c-success btn-sm" type="button" data-id="<?php echo $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#edit-modal">
                                                        <i class="bx bx-edit"></i>
                                                    </button>
                                                    <a href="delete-service-option.php?id=<?php echo $row['id'] ?>&service_id=<?php echo $_GET['service_id'] ?>" class="delete-option btn btn-c-danger btn-sm">
                                                        <i class="bx bx-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/modals/service-option-modals.php' ?>
    <?php include './includes/scripts.php' ?>
    <?php include './includes/alerts.php' ?>
    <script>
        $("#edit-modal").on("show.bs.modal", function(e) {
            let toggler = $(e.relatedTarget)
            let label = toggler.data("option-label")
            let price = toggler.data("option-price")
            let id = toggler.data("id")

            $("#edit-label").val(label)
            $("#edit-price").val(price)
            $("#edit-id").val(id)
        })

        $(".delete-option").on("click", function(e) {
            e.preventDefault();
            let url = $(this).attr("href")
            Notiflix.Confirm.show(
                'Confirm Action',
                'Delete Service Option?',
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