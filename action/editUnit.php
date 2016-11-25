<?php

include "../config.php";
$id = $_POST['modal_id'];
$nama = $_POST['nama_unit'];
$modal = "UPDATE "
        . "unit "
        . "SET "
        . "nama = '$nama'"
        . " WHERE id = '$id'";
mysql_query($modal);
header('location:../index.php?wr=unit&page=view');
