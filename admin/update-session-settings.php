<?php 
    include './includes/Session.php';

    if(isset($_POST['state'])){
        Session::insertSession("partyjungle-sidebar-state", $_POST['state']);
    }
    echo json_encode([
        "success"=>true,
        "state"=>$_POST['state']
    ])

?>