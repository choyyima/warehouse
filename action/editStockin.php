<?php

include '../config.php';
$id = $_POST['id'];
$tanggal_masuk = $_POST['tanggal_masuk'];
$proyek = $_POST['proyek'];
$tujuan = $_POST['tujuan'];
$nama_barang = $_POST['nama_barang'];
$jumlah = $_POST['jumlah'];
$satuan = $_POST['satuan'];
$status = $_POST['status'];
$memo = $_POST['memo'];

if ($id > 0) {
    $qStockOut = "select * from stockout where id_stockin = $id";
}

$sql = "update `stockin` SET "
        . "`tanggal_masuk`='$tanggal_masuk', "
        . "`asal_proyek`='$proyek', "
        . "`lokasi_simpan`='$tujuan', "
        . "`nama_barang`='$nama_barang', "
        . "`jumlah`='$jumlah', "
        . "`satuan`='$satuan', "
        . "`kondisi`='$status', "
        . "`keterangan`='$memo' "
        . "WHERE `id`='$id'";

$result = mysql_query($sql);

if ($result) {
    echo "<script>alert('Berhasil dirubah.')</script>";
    echo "<script type='text/javascript'>document.location='../index.php?wr=stockin&page=view'; </script>";
} else {
    echo "<script>alert('Gagal! tidak dapat dirubah.')</script>";
}