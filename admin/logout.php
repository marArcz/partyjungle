<?php 
   include '../conn/conn.php';
   include './includes/Session.php';

   Session::destroyUserSession();

   Session::redirectTo("index.php");
?>