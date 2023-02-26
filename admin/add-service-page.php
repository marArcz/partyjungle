<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service | Admin </title>
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
                        <p class="fs-4 fw-bold my-0"> Add Service</p>
                    </div>
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="services.php" class=" text-decoration-none">Services</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Service</li>
                        </ol>
                    </nav>
                    <div class="card rounded-4 shadow-sm border-0">
                        <div class="card-body">
                            <form action="add-service.php" enctype="multipart/form-data" method="post">
                                <p class="form-text">Details</p>
                                <div class="mb-3">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3">
                                            <img src="../assets/images/logo1.jpg" name="photo" class="img-fluid img-thumbnail" id="service-photo" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Photo:</label>
                                    <input type="file" class="form-control file-input" data-img-preview="#service-photo" name="photo">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Service Name:</label>
                                    <input type="text" required class="form-control" name="service_name">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Description:</label>
                                    <textarea name="description" class="form-control" rows="3"></textarea>
                                </div>
                                <hr>
                                <p class="form-text">Service options</p>
                                <div class="text-end mb-2">
                                    <button class="btn-sm btn-brown btn" type="button" id="add-option-btn">Add Option</button>
                                </div>
                                <div id="options-row" class="mb-3">
                                    <div class="card rounded-1 border">
                                        <div class="card-body">
                                            <div class="row align-items-end">
                                                <div class="col-sm">
                                                    <label for="" class="form-label">Label:</label>
                                                    <input type="text" required class="form-control form-control-sm" name="labels[]">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="" class="form-label">Price:</label>
                                                    <input type="number" required class="form-control form-control-sm" name="prices[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-orange" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <?php include './includes/scripts.php' ?>
    <script>
        $(function(e) {
            $("#add-option-btn").on('click', function(e) {
                let optionRow = `<div class="card rounded-1 border mb-3">
                                        <div class="card-body">
                                        <div class="text-end">
                                                <button class="btn btn-c-danger remove-option btn-sm" type="button">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                        </div>
                                            <div class="row align-items-end">
                                                <div class="col-sm">
                                                    <label for="" class="form-label">Label:</label>
                                                    <input type="text" required class="form-control form-control-sm" name="labels[]">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="" class="form-label">Price:</label>
                                                    <input type="number" required class="form-control form-control-sm" name="prices[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                $("#options-row").prepend(optionRow)

                $(".remove-option").on("click", function(e) {
                    $(this).parent().parent().parent().remove();
                })
            })
        })
    </script>
</body>

</html>