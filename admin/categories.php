<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Categories </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "categories";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state")? (Session::getSession("partyjungle-sidebar-state",false) == "close"? 'sidebar-closed':''):'' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-category bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Categories</p>
                    </div>
                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#add-modal">Add New</button>
                    </div>
                    <div class="card rounded-4 shadow-sm border-0">
                        <div class="card-body ">
                            <table class="table " id="table">
                                <thead>
                                    <th>Category Name</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM categories");
                                    while ($row = $query->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['category_name'] ?></td>
                                            <td>
                                                <img src="../<?php echo $row['category_photo'] ?>" alt="">
                                            </td>
                                            <td>
                                                <a href="#edit-modal" data-bs-toggle="modal" data-id="<?php echo $row['id'] ?>" class="link-dark">
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
            </section>
        </main>
    </div>
    <?php include './includes/modals/categories-modal.php' ?>
    <?php include './includes/scripts.php' ?>
    <?php include './includes/alerts.php' ?>
    <script>
        $("#edit-modal").on("show.bs.modal", function(e) {
            let id = $(e.relatedTarget).data('id');

            $.ajax({
                url: "get-category.php",
                method: "POST",
                data: {
                    id
                },
                dataType:'json',
                success: function(res) {
                    console.log(res);
                    $("#name").val(res.category_name)
                    $("#id-input").val(res.id)
                    $("#photo").attr('src', "../"+res.category_photo)

                    $("#delete-btn").attr("href",`delete-category.php?id=${res.id}`)
                },
                error: function(err) {
                    console.log("Erorr: ", err);
                }
            })
        })
    </script>
</body>

</html>