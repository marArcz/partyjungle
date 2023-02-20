<?php include '../conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin </title>
    <?php include './includes/header.php' ?>
</head>

<body class="bg-gray">
    <div class="wrapper">
        <?php
        $active_page = "shipping";
        include './includes/sidebar.php'
        ?>
        <main class="main-container">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-truck bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Shipping Options</p>
                    </div>

                    <div class="card rounded-4 border-0">
                        <div class="card-body">
                            <table class="table" id="table">
                                <thead>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $query = mysqli_query($con,"SELECT * FROM shipping");
                                        while($row = $query->fetch_assoc()){
                                            ?>
                                            <tr>
                                                <td><?php echo $row['description'] ?></td>
                                                <td><?php echo $row['price'] ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-c-success" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="<?php echo $row['id'] ?>" type="button">
                                                       <i class="bx bx-edit"></i> 
                                                    </button>
                                                    <!-- <a href="delete-shipping.php" class="btn btn-sm btn-danger delete" data-id="<?php echo $row['id'] ?>" type="button">
                                                       <i class="bx bx-trash"></i> Delete
                                                    </a> -->
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
    <?php include './includes/alerts.php' ?>
    <?php include './includes/modals/shipping-modals.php' ?>
    <script>
        $("#edit-modal").on("show.bs.modal",function(e){
            var id = $(e.relatedTarget).data('id');

            showLoading();

            $.ajax({
                url:"get-shipping.php",
                method:"post",
                data:{id},
                dataType:'json',
                success:function(res){
                    hideLoading();
                    $("#id-input").val(id);
                    $("#edit-description").val(res.description);
                    $("#price").val(res.price);
                }
            })
        })
    </script>
</body>

</html>