<?php
include './config.php';

$getVal = $_GET['unit'];
if (isset($getVal)) {
    $query = "select * from stockin where unit = '$getVal'";
    $exct = mysql_query($query);
    $result = mysql_fetch_array($exct);

    echo json_encode($result);
}