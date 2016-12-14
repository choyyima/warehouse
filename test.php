<?php
include './config.php';

$title = $_POST["title"];

$result = mysql_query("SELECT * FROM stockin where nama_barang like '%$title%'");
$found = mysql_num_rows($result);

if ($found > 0) {
    while ($row = mysql_fetch_array($result)) {
        echo "<li>$row[nama_barang]</br></li>";
    }
} else {
    echo "<li>No Tutorial Found<li>";
}