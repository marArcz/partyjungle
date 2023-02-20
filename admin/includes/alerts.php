<script>
    <?php
    if (Session::hasSession("success")) {
    ?>
        Notiflix.Notify.success("<?php echo Session::getSuccess() ?>",{
            position: "center-top",
            background:"#FC6603"
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