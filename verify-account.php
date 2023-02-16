<?php include './conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include './includes/header.php' ?>
</head>

<body class="">
    <div class="navbar navbar-light bg-yellow shadow-sm">
        <div class="container">
            <img src="./assets/images/ban_img1.png" width="70px" class="img-fluid" alt="">
            <a href="#" class="navbar-brand  me-auto fw-bold fs-5 ms-2">Sign up</a>
            <a href="logout.php" class="link-dark">Sign out</a>
        </div>
    </div>
    <main class="main">
        <section class="signup">
            <div class="container">
                <div class="row my-5 align-items-center justify-content-center">
                    <div class="col-md-5">

                        <div class="card border-0 shadow rounded-3">
                            <div class="card-body p-5">
                                <div class="d-flex align-items-center mb-3">
                                    <a href="logout.php" class="link-orange">
                                        <i class="bx bx-arrow-back fs-4"></i>
                                    </a>
                                    <p class="my-1 fs-5 ms-auto me-auto">Verify your account</p>
                                </div>
                                <div class="text-center my-3">
                                    <img src="./assets/images/logo1.png" class="img-fluid" alt="">
                                </div>
                                <form action="verify-submit.php" autocomplete="off" method="post">
                                    <input type="hidden" name="code" id="input-code">
                                    <div class="text-center fw-light mb-3">
                                        <p class="my-1 fw-light text-secondary">We sent a verification code to your email address.</p>
                                        <p class="my-1 text-secondary">johndoe@gmail.com</p>
                                    </div>
                                    <?php
                                    if (Session::hasSession("error")) {
                                    ?>
                                        <div class="alert alert-danger py-2">
                                            <small><i class="bx bx-info-circle"></i> <?php echo Session::getError() ?></small>
                                        </div>
                                    <?php
                                    }
                                    else if (Session::hasSession("success")) {
                                        ?>
                                            <div class="alert alert-success py-2">
                                                <small><i class="bx bx-check-circle"></i> <?php echo Session::getSuccess() ?></small>
                                            </div>
                                        <?php
                                        }
                                    ?>
                                    <br><br>
                                    <div id="code-input-group">
                                        <div class="row mb-3">
                                            <div class="col">
                                                <input autocapitalize="on" autocomplete="off" data-index="0" autofocus type="text" maxlength="1" class="code-input text-center border-start-0 border-end-0 border-top-0 w-100">
                                            </div>
                                            <div class="col">
                                                <input autocapitalize="on" autocomplete="off" data-index="1" disabled type="text" maxlength="1" class="code-input text-center border-start-0 border-end-0 border-top-0 w-100">
                                            </div>
                                            <div class="col">
                                                <input autocapitalize="on" autocomplete="off" data-index="2" disabled type="text" maxlength="1" class="code-input text-center border-start-0 border-end-0 border-top-0 w-100">
                                            </div>
                                            <div class="col">
                                                <input autocapitalize="on" autocomplete="off" data-index="3" disabled type="text" maxlength="1" class="code-input text-center border-start-0 border-end-0 border-top-0 w-100">
                                            </div>
                                            <div class="col">
                                                <input autocapitalize="on" autocomplete="off" data-index="4" disabled type="text" maxlength="1" class="code-input text-center border-start-0 border-end-0 border-top-0 w-100">
                                            </div>
                                            <div class="col">
                                                <input  autocapitalize="on" autocomplete="off"data-index="5" disabled type="text" maxlength="1" class="code-input text-center border-start-0 border-end-0 border-top-0 w-100">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center my-5">
                                        <p class="mb-2">Did not recieve the code?</p>
                                        <a class="link-orange" href="resend-verification.php">
                                            <small>Click here to resend code.</small>
                                        </a>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-orange" disabled id="submit-btn" type="submit" name="submit">Verify Account</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include './includes/scripts.php' ?>
    <script>
        $(function(){

        })

        $(".code-input").on("keydown", function(e) {
            console.log("key: ", e.keyCode)


            if (e.keyCode == 32) {
                e.preventDefault()
                return;
            }
            // if (e.keyCode >= 124 && e.keyCode <= 249) {
            //     e.preventDefault()
            //     return;
            // }

            var inputs = $(".code-input");
            var index = $(this).data('index')
            if (e.key === "Backspace") {
                console.log('val: ', $(this).val())
                if (index > 0 && $(this).val() === "") {
                    $(this).attr("disabled", true)
                    $(inputs[--index]).removeAttr("disabled").val("").focus()
                    $("#submit-btn").attr("disabled", true)

                } else {
                    $("#submit-btn").attr("disabled", true)
                }
                return
            }


        })
        $(".code-input").on("keyup", function(e) {
            var inputs = $(".code-input");
            var index = $(this).data('index')
            let numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            let count = inputs.length;
            // if (!numbers.includes(Number(e.key))) {
            //     console.log('not a number');
            //     e.preventDefault();
            //     return;
            // } else {
            //     console.log(index)

            // }

            if (e.keyCode == 32) {
                e.preventDefault()
                return;
            }
            if (index < 5) {
                if ($(this).val() != "") {
                    $(this).attr("disabled", true)
                    $(inputs[++index]).removeAttr('disabled').focus()
                }
            } else {
                $("#submit-btn").removeAttr("disabled")
                let code = ""
                // $.each(".code-input",function(i,elem){
                //     code += $(elem).val();
                // })

                let inputs = $(".code-input")
                for(let input of inputs){
                    code += $(input).val();
                }

                $("#input-code").val(code);
                console.log($in)
            }
        })
    </script>
</body>

</html>