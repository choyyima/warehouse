<?php

$admin = $_GET['wr'];
$act = $_GET['do'];
if (isset($admin)) {
    if ($admin == 'unit') {
        switch ($act) {
            case "save" :
                $nama_unit = $_POST['nama_unit'];
                InsertUnit($namaVal);
            case "update" :
                $namaVal = $_POST['nama'];
                $wali = $_POST['namaortu'];
                $kelas = $_POST['kelas'];
                $alamat = $_POST['alamat'];
                $email = $_POST['email'];
                $telp = $_POST['telp'];
                $id = $_POST['idSiswa'];
                UpdateSiswa($namaVal, $wali, $kelas, $alamat, $email, $telp, $id);
            case "delete" :
                $idSiswa = $_GET['id'];
                DeleteSiswa($idSiswa);
            default :
                include 'frmSiswa.php';
        }
    }
}

