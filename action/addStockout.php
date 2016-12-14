<?php

include '../config.php';
$tanggal_keluar = $_POST['tanggal_keluar'];
$no_sj = $_POST['no_sj'];
$nama_barang = $_POST['nama_barang'];
$jumlah_ambil = $_POST['jumlah_ambil'];
$total = $_POST['total'];
$destination = $_POST['destination'];
$ovb = $_POST['ovb'];
$jumlah = $_POST['jumlah'];

$sql = "insert into `stockout` SET "
        . "`tanggal_keluar`='$tanggal_keluar', "
        . "`no_surat_jalan`='$no_sj', "
        . "`jumlah_diambil`='$jumlah_ambil', "
        . "`total`='$total', "
        . "`tujuan`='$destination', "
        . "`no_memo_ovb`='$ovb', "
        . "`id_stock_in`='$nama_barang' ";
//echo $sql;die();

$resultq = mysql_query($sql);

//if (!empty($jumlah_ambil)) {
$sum = $jumlah - $jumlah_ambil;
mysql_query("UPDATE `stockin` SET `jumlah`='$sum' WHERE (`id`='$nama_barang')");
//}

if ($resultq) {
    $sum = $jumlah - $jumlah_ambil;
    mysql_query("UPDATE `stockin` SET `jumlah`='$sum' WHERE (`id`='$nama_barang')");
    
    echo "<script>alert('Berhasil ditambah.')</script>";
    echo "<script type='text/javascript'>document.location='../index.php?wr=stockout&page=view'; </script>";
} else {
    echo "<script>alert('Gagal! tidak dapat ditambah.')</script>";
    echo "<script type='text/javascript'>document.location='../index.php?wr=stockout&page=view'; </script>";
}

