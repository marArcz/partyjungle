<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
<script src="..\assets\notiflix\dist\notiflix-3.2.6.min.js"></script>
<script src="..\assets\@popperjs\core\dist\umd\popper.min.js"></script>
<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="..\assets\fontawesome-free-6.3.0-web\js\fontawesome.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1.3.4/dist/axios.min.js"></script>
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

        $(".div-image").each((i, elem) => {
            let img = $(elem).data("img")
            $(elem).css("background-image", `url(${img})`)
        })

        $("img.view-photo").on("click", function(e) {
            let img = $(this).attr("src");

            $("#view-photo-modal").find("img").attr("src", img);
            $("#view-photo-modal").modal("show");
        })
        $("div.view-photo").on("click", function(e) {
            let img = $(this).data("img");

            $("#view-photo-modal").find("img").attr("src", img);
            $("#view-photo-modal").modal("show");
        })
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

    $("#sidebar-collapse-btn").on("click", function(e) {
        $("#sidebar-wrapper").toggleClass("close");
        $(".main-container").toggleClass("sidebar-closed");
        var state = "";
        if ($("#sidebar-wrapper").hasClass("close")) {
            state = "close";
        }

        $.post("update-session-settings.php", {
            state
        }, (res) => {
            console.log('res: ', res)
        })

    })
</script>