<?php
include '../conn/conn.php';

$order_statistics = [];
$i = 0;
for ($month = 1; $month <= 12; $month++) {
    $count = mysqli_query($con, "SELECT COUNT(id) FROM orders WHERE MONTH(ordered_at) = $month")->fetch_array()[0];
    array_push($order_statistics,$count);
}
echo json_encode([
    "statistics" => $order_statistics
]);
