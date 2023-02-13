<script>
    <?php 
        if(Session::hasSession("success")){
            ?>
            showSuccessDialog({message:"<?php echo Session::getSuccess() ?>"});
            <?php
        }
        else if(Session::hasSession("error")){
            ?>
            showErrorDialog({message:"<?php echo Session::getError() ?>"});
            <?php
        }
    ?>
</script>