<?php include './conn/conn.php' ?>
<?php include './includes/Session.php' ?>
<?php include './includes/verifyUserSession.php' ?>
<?php include './admin/includes/OrderStatus.php' ?>
<?php 
    if(Session::getUser() == null){
        $url = $_SERVER['REQUEST_URI'];
        Session::redirectTo("login.php?source=$url");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party Jungle Toys & Party Needs</title>
    <?php $active_page = "services" ?>
    <?php include './includes/header.php' ?>

</head>

<body class="bg-light">
    <?php include './includes/top_header.php' ?>
    <main class="main">
        <section>
            <?php
            if (!isset($_GET['service_id'])) {
                Session::redirectTo("services.php");
                exit();
            }
            $user_id = Session::getUser()['id'];
            // get product
            $service_id = $_GET['service_id'];
            $option_id = $_GET['option_id'];
            $service = mysqli_query($con, "SELECT * FROM services WHERE id = $service_id")->fetch_assoc();
            $option = mysqli_query($con, "SELECT * FROM service_options WHERE id = $option_id")->fetch_assoc();
            ?>
            <div class="container my-5">
                <h4 class="">Schedule Service</h4>
                <div class="card border-0 shadow-sm border-top border-orange rounded-0 mb-3">
                    <div class="card-body">
                        <form action="">
                            <p class="form-text">Service Details</p>
                            <p><?php echo $service['name'] ?></p>
                            <p class="text-secondary"><?php echo $service['description'] ?></p>
                            <p><i class="bx bxs-circle text-brown"></i> <?php echo $option['label'] ?> - <span class="text-orange">₱ <?php echo $option['price'] ?></span></p>
                        </form>
                    </div>
                </div>
                <div class="card border-0 shadow-sm border-top rounded-0">
                    <div class="card-body">
                        <p class="form-text">Set Schedule</p>
                        <div class="row">
                            <div class="col-md-9">
                                <div id="calendar"></div>
                            </div>
                            <div class="col-md">
                                <div class="card rounded-0 border">
                                    <div class="card-body">
                                        <form action="add-service-reservation.php" method="post">
                                            <input type="hidden" class="form-control" name="date" id="date">
                                            <input type="hidden" class="form-control" id="service-id" name="service_id" value="<?php echo $service_id ?>">
                                            <input type="hidden" class="form-control" name="option_id" value="<?php echo $option_id ?>">

                                            <div class="mb-3">
                                                <label for="" class="form-label">Selected Date:</label>
                                                <input type="text" class="form-control" id="text-date" disabled value="No Selected">
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Time:</label>
                                                <input type="time" name="time" class="form-control" required>
                                            </div>
                                            <div class="d-grid">
                                                <button class="btn btn-orange btn-sm" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
    <!-- footer -->
    <?php include './includes/service-modals.php' ?>
    <?php include './includes/footer.php' ?>
    <?php include './includes/scripts.php' ?>
    <script>
        $(function(e) {
            const calendar = new Calendar({
                element: "#calendar",
                disableDateWithEvents: true
            })
            calendar.createCalendar()


            loadReservations()
                .then(res => {
                    console.log('reservations: ', res)
                    calendar.eventList = res.reservations
                    calendar.loadDays()
                    calendar.setOnSelectDate((date, day) => {
                        if (day.events == 0) {
                            const formatNum = (num) => num < 10 ? "0" + num : num
                            let strDate = date.getFullYear() + "-" + formatNum(date.getMonth() + 1) + "-" + formatNum(date.getDate());
                            $("#date").val(strDate);
                            $("#text-date").val(strDate);
                        }else{
                            if(day.events[0].owned){
                                //if event is owned
                                $("#service-modal").modal("show")
                            }
                        }

                    })
                })
        })

        async function loadReservations() {
            return $.ajax({
                url: "get-reservations.php",
                method: "post",
                dataType: "json",
                data: {
                    service_id: $("#service-id").val()
                },
                success: res => res,
                error: err => err
            })
        }
    </script>
</body>

</html>