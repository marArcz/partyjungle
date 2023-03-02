<?php 
    include '../conn/conn.php';
    include './includes/Session.php';

    echo json_encode(Session::getUser());
?>