<?php
include './config.php';
/* ----------------------------------------------------- Insert Unit ------------------------------------------------------------- */

function InsertUnit($nama_unit) {
    $nama_unit = $_POST['nama_unit'];
    $qUnit = "insert into `unit` SET "
            . "`nama`='$nama_unit'";

    $rUnit = mysql_query($qUnit);
    if ($rUnit) {
        echo "<script>alert('Berhasil ditambah.')</script>";
        echo "<script type='text/javascript'>document.location='./index.php?wr=unit&page=view'; </script>";
    } else {
        echo "<script>alert('Gagal! tidak dapat ditambah.')</script>";
    }
    return $rUnit;
}
