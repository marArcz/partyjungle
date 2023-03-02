<?php 
    include '../conn/conn.php';

    $sales = [];
    $year = date('Y');
    $i=0;
    for($month=1;$month<=12;$month++){
        $query = mysqli_query($con,"SELECT SUM(price) FROM order_details WHERE order_id IN (SELECT id FROM orders WHERE MONTH(ordered_at) = $month AND YEAR(ordered_at) = $year AND status IN (SELECT status_code FROM order_status WHERE status_label = 'Delivered'))");
        array_push($sales,$query->fetch_array()[0]);
    }

    echo json_encode(['sales'=>$sales]);
?>