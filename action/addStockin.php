<?php

include '../config.php';
$tanggal_masuk = $_POST['tanggal_masuk'];
$proyek = $_POST['proyek'];
$tujuan = $_POST['tujuan'];
$nama_barang = $_POST['nama_barang'];
$jumlah = $_POST['jumlah'];
$satuan = $_POST['satuan'];
$status = $_POST['status'];
$no_sj = $_POST['no_sj'];
$memo = $_POST['memo'];

$sql = "insert into `stockin` SET "
        . "`tanggal_masuk`='$tanggal_masuk', "
        . "`proyek`='$proyek', "
        . "`lokasi`='$tujuan', "
        . "`type`='$nama_barang', "
        . "`jumlah`='$jumlah', "
        . "`satuan`='$satuan', "
        . "`status`='$status', "
        . "`no_surat_jalan`='$no_sj', "
        . "`keterangan`='$memo' ";

$resultq = mysql_query($sql);
if ($resultq) {
    echo "<script>alert('Berhasil ditambah.')</script>";
    echo "<script type='text/javascript'>document.location='../index.php?wr=stockin&page=view'; </script>";
} else {
    echo "<script>alert('Gagal! tidak dapat ditambah.')</script>";
}

