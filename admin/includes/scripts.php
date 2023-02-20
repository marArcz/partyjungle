<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
<script src="..\assets\notiflix\dist\notiflix-3.2.6.min.js"></script>
<script src="..\assets\@popperjs\core\dist\umd\popper.min.js"></script>
<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="..\assets\fontawesome-free-6.3.0-web\js\fontawesome.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
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
        Notiflix.Notify.init({
            position: 'center-top',
            closeButton: false,
        });
    })

    const showLoading = () => {
        return Notiflix.Loading.standard("Please wait");
    }
    const hideLoading = () => {
        return Notiflix.Loading.remove(1000);

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


    $("#table").DataTable()

    $(".file-input-toggler").on("click", function(e) {
        var target = $($(this).data("target"));
        target.on("change", function(e) {
            let files = e.target.files;
            var previewElem = $($(this).data("img-preview"));

            previewElem.attr("src", URL.createObjectURL(files[0]));
        })
        target.click();

    })

    $(".file-input").on("change", function(e) {
        let files = e.target.files;
        var previewElem = $($(this).data("img-preview"));

        previewElem.attr("src", URL.createObjectURL(files[0]));
    })
</script>