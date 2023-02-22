<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
<script src="assets\notiflix\dist\notiflix-3.2.6.min.js"></script>
<script src=".\assets\@popperjs\core\dist\umd\popper.min.js"></script>
<script src="./assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src=".\assets\fontawesome-free-6.3.0-web\js\fontawesome.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@pnotify/core@5.2.0/dist/PNotify.min.js"></script>
<script src="./assets/jquery-ph-locations-master/jquery.ph-locations-v1.0.0.js"></script>
<script>
    $(function() {
        Notiflix.Loading.init({
            backgroundColor: 'rgba(240,240,240,0.6)',
            svgColor: '#FC6603',
            clickToClose: false,
        });
        Notiflix.Report.init({
            backOverlayColor: 'rgba(240,240,240,0.6)',
        });

        $("#table").DataTable();
    })

    const showLoading = () => {
        return Notiflix.Loading.standard("Please wait");
    }
    const hideLoading = () => {
        return Notiflix.Loading.remove(200);

    }

    const showSuccessDialog = (option = {}) => {
        return Notiflix.Report.success(
            option.title || "Success!",
            option.message || "",
            option.confirmText || 'Okay',

        );
    }

    const showErrorDialog = (option = {}) => {
        return Notiflix.Report.failure(
            option.title || 'Failed!',
            option.message || 'Something went wrong try again later!',
            option.confirmText || 'Okay',

        );
    }

    <?php
    if (Session::hasSession("welcome")) {
    ?>
        showSuccessDialog("Welcome to Party Jungle!", {
            message: "<?php echo Session::getSuccess() ?>"
        })
    <?php
    } else if (Session::hasSession("success")) {
    ?>
        showSuccessDialog({
            message: "<?php echo Session::getSuccess() ?>"
        })
    <?php
    } else if (Session::hasSession("error")) {
    ?>
        showErrorDialog({
            message: "<?php echo Session::getError() ?>"
        });
    <?php
    }
    ?>
</script>