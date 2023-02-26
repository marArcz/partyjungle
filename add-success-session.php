<?php 
    include './includes/Session.php';

    Session::insertSuccess($_GET['message']);

    Session::redirectTo($_GET['route']);
?>