<?php

include 'config.php';
$jumMK = $_POST['jumMK'];

for ($i = 1; $i <= $jumMK; $i++) {
//    $mk = $_POST['mk'];
    $matkul = $_POST['mk' . $i];
    if (!empty($mk)) {
        $query = "INSERT INTO user (lokasi)  VALUES('$matkul')";
        mysql_query($query);
    }
}

echo "Terimakasih sudah memilih matakuliah";


