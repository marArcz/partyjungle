<?php include './conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<?php include './includes/verifyUserSession.php' ?>
<?php include './admin/includes/OrderStatus.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Jungle Toys & Party Needs</title>
    <?php $active_page = "account" ?>
    <?php include './includes/header.php' ?>
    <style>
        .manage-account-list li {
            cursor: pointer;
        }

        .manage-account-list li:hover {
            background: rgb(245, 245, 245);
        }
    </style>
</head>

<body class="bg-light">
    <?php include './includes/top_header.php' ?>
    <?php $user = Session::getUser() ?>
    <main class="main">
        <section>
            <div class="container my-5">
                <h5>My Account</h5>
                <hr>
                <div class="card rounded-1 border-0 shadow-sm border-top">
                    <div class="card-body">
                        <p class="card-text text-secondary">
                            <small>Manage Account</small>
                        </p>
                        <ul class="list-group list-group-flush manage-account-list">
                            <li class="list-group-item" id="list-item-photo">
                                <a href="#photo-modal" data-bs-toggle="modal" class="link-secondary">
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <p class="my-1 text-secondary fw-light">Photo</p>
                                        </div>
                                        <div class="col-md">
                                            <?php
                                            if (!empty($user['photo'])) {
                                            ?>
                                                <div class="div-image account-photo" data-image="<?php echo $user['photo'] ?>">
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <i class=" bx bx-user-circle fs-3 text-secondary"></i>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#info-modal" data-bs-toggle="modal">
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <p class="my-1 text-secondary fw-light">Name</p>
                                        </div>
                                        <div class="col-md">
                                            <p class="my-1 text-secondary">
                                                <?php echo $user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <p class="my-1 text-secondary fw-light">Email</p>
                                        </div>
                                        <div class="col-md">
                                            <p class="my-1 text-secondary">
                                                <?php echo $user['email'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <p class="my-1 text-secondary fw-light">Contact</p>
                                        </div>
                                        <div class="col-md">
                                            <p class="my-1 text-secondary">
                                                <?php echo $user['contact'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <p class="my-1 text-secondary fw-light">Address</p>
                                        </div>
                                        <div class="col-md">
                                            <p class="my-1 text-secondary">
                                                <?php echo $user['address'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-2">
                                            <p class="my-1 text-secondary fw-light">Username</p>
                                        </div>
                                        <div class="col-md">
                                            <p class="my-1 text-secondary">
                                                <?php echo $user['username'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="#password-modal" class="link-dark" data-bs-toggle="modal">
                                    <div class="row mt-3">
                                        <div class="col-md-2">
                                            <p class="my-1 text-secondary">Password</p>
                                        </div>
                                        <div class="col-md">
                                            <p class="my-1">
                                                *********************
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include './includes/featured-products.php';
        ?>
    </main>
    <!-- footer -->
    <?php include './includes/footer.php' ?>
    <?php include './includes/chat.php' ?>
    <?php include './includes/account-modals.php' ?>
    <?php include './includes/scripts.php' ?>
    <script>
        $("#info-modal").on("show.bs.modal", function(e) {
            Notiflix.Block.circle('#info-modal form');

            $.post("get-account.php", (res) => {
                console.log(res)
                $("#info-username").val(res.username);
                $("#info-firstname").val(res.firstname);
                $("#info-middlename").val(res.middlename);
                $("#info-lastname").val(res.lastname);
                $("#info-email").val(res.email);
                $("#info-address").val(res.address);
                $("#info-contact").val(res.contact);
                Notiflix.Block.remove('#info-modal form', 1000);

            }, "json");
        })

        $("#password-form").on("submit", function(e) {
            e.preventDefault();
            let current_pass = $("#current-password").val();
            let new_pass = $("#new-password").val();
            let confirm_pass = $("#confirm-password").val();
            Notiflix.Block.circle('#password-modal form');
            if (new_pass != confirm_pass) {
                Notiflix.Block.remove('#password-modal form');
                Notiflix.Notify.failure("Passwords does not match please check!");
                $("#password-form-error").html("Passwords does not match please check!");
                return;
            }else{

                $("#password-form-error").html("");

            }
            $.ajax({
                url: "change-password.php",
                method: "post",
                data: {
                    current_pass,
                    new_pass
                },
                dataType:'json',
                success: function(res) {
                    console.log('res: ', res)
                    if (res.success) {
                        window.location.href = "add-success-session.php?message=Successfully changed!&route=account.php"
                    } else {
                        Notiflix.Notify.failure(res.error);
                        $("#password-form-error").html(res.error);
                        Notiflix.Block.remove('#password-modal form', 1000);

                    }
                }
            })
        })
    </script>
</body>

</html>