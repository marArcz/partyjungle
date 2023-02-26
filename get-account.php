<?php 
    include './conn/conn.php';
    include './includes/Session.php';

   $user = Session::getUser();

   echo json_encode($user);

?>