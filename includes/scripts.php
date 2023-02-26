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
<script src=".\assets\js\main.js"></script>
<script src=".\assets\js\user-chats.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1.3.4/dist/axios.min.js"></script>
<script src="./assets/calendar/js/Calendar.js"></script>
<script>
   
    $(function() {
        $(".div-image").each((index, elem) => {
            let image = $(elem).data("image");
            $(elem).css('background-image', `url(${image})`);
        })
        Notiflix.Loading.init({
            backgroundColor: 'rgba(240,240,240,0.6)',
            svgColor: '#FC6603',
            clickToClose: false,
        });
        Notiflix.Report.init({
            backOverlayColor: 'rgba(240,240,240,0.6)',
        });
        Notiflix.Block.init({
            backgroundColor: 'rgba(255,255,255,0.5)',
        });
        Notiflix.Notify.init({
            position: 'center-top',
            closeButton: false,
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

    $(".file-input").on("change", function(e) {
        let files = e.target.files;
        var previewElem;
        if ($(this).attr("img-preview")) {
            previewElem = $($(this).data("img-preview"));
            previewElem.attr("src", URL.createObjectURL(files[0]));
        } else {
            previewElem = $($(this).data("div-preview"));
            previewElem.css("background-image", `url(${URL.createObjectURL(files[0])})`);
        }
    })

    <?php
    if (Session::hasSession("welcome")) {
    ?>
        Notiflix.Notify.success("<?php echo Session::getSession("welcome") ?>", {
            position: "center-top"
        })
    <?php
    } else if (Session::hasSession("success")) {
    ?>
        Notiflix.Notify.success("<?php echo Session::getSuccess() ?>", {
            position: "center-top"
        })
    <?php
    } else if (Session::hasSession("error")) {
    ?>
        Notiflix.Notify.failure("<?php echo Session::getError() ?>", {
            position: "center-top"
        })
    <?php
    }
    ?>
</script>