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
        $active_page = "account";
        include './includes/sidebar.php'
        ?>
        <main class="main-container <?php echo Session::hasSession("partyjungle-sidebar-state")? (Session::getSession("partyjungle-sidebar-state",false) == "close"? 'sidebar-closed':''):'' ?>">
            <?php include './includes/top_header.php' ?>
            <section class="main-content">
                <div class="container-fluid py-3">
                    <div class="d-flex align-items-end mb-4">
                        <span class="card-icon card-icon-sm me-2 shadow-sm">
                            <i class="bx bxs-cog bx-sm"></i>
                        </span>
                        <p class="fs-4 fw-bold my-0"> Account Settings</p>
                    </div>
                    <div class="card shadow-sm border-0">
                        <div class="card-body"></div>
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