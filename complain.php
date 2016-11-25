<?php
include "config.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <div class="header">
            <h1 class="page-title">Form Complain</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Form Complain</li>
            </ul>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="panel panel-default">
                    <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Form Complain</a>
                    <div id="widget1container" class="panel-body collapse in">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane active in" id="home">
                                <form name="complain" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="form-group">
                                        <label>Name / Nama</label>
                                        <input type="text" name="nama" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number / No. Telp.</label>
                                        <input type="text" name="no_tlp" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Project / Proyek</label>
                                        <input type="text" name="proyek" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Position / Jabatan</label>
                                        <input type="text" name="jabatan" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Order Number / No. Order</label>
                                        <input type="text" name="no_order" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Record Complain / Catatan Komplain</label>
                                        <textarea rows="5" class="form-control" name="catatan"></textarea>
                                    </div>
                                    <div class="btn-toolbar list-toolbar">
                                        <button class="btn btn-primary" name="save" type="submit"><i class="fa fa-send"></i> Sent</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
//$generate_no = date('dmy') . ;
        if (isset($_POST['save'])) {
            $nama = $_POST['nama'];
            $proyek = $_POST['proyek'];
            $no_order = $_POST['no_order'];
            $no_tlp = $_POST['no_tlp'];
            $catatan = $_POST['catatan'];
            $jabatan = $_POST['jabatan'];
            $date = date("d M Y");
            $offset = 7 * 60 * 60; //converting 7 hours to seconds.
            $dateFormat = "d M Y - H:i";
            $timeNdate = gmdate($dateFormat, time() + $offset);

            $sql = "INSERT INTO email SET nama = '$nama', no_tlp='$no_tlp', proyek='$proyek', date ='$date',
	    jabatan='$jabatan', no_order='$no_order', catatan_komplin='$catatan', user_id='$get[oId]'";

            $result = mysql_query($sql);

            if ($result) {
                $body_mail = "<html>
			<body>
				<p>Dear <b>Purchasing</b>, 
				<br>Pada tanggal $timeNdate .
				<br>Telah menerima laporan dari <b>$jabatan</b> bernama <b>$nama</b>, no. telp <b>$no_tlp</b>.
				<br>Pada proyek <b>$proyek</b>, no. order <b>$no_order</b>. 
				<br>Ada komplain sebagai berikut:  
				<br>
				<br><i>" . $catatan . "</i>
				<br>
				<br>
				<br>Regards,
				<br>
				<br>
				<br>Procurement Information Center
				<br>orderkantor.com</p></body></html>";
                $headers = "From: orderkantor.com\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $mail_sent = @mail("purchasing@aryana.co.id, procurement@aryana.co.id, it-support@aryana.co.id, ekspedisi@aryana.co.id", "Complain From Procurement Information Center - " . $date . " - ($time)", $body_mail, $headers);
                echo "<script>alert('Pesan Telah Dikirim.')</script>";
                echo "<script type='text/javascript'>document.location='./index.php?pic=complain&page=status'; </script>";
            } else {
                echo "<script>alert('Pesan Tidak Dapat Dikirim.')</script>";
            }
        }
    } elseif ($_GET['page'] === "status") {
        ?>
        <div class="header">
            <h1 class="page-title">Complain Status</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Complain Status</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Complain Status</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <table id="data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>
                                            <th width="80px">Date</th>
                                            <th>Name </th>
                                            <th>No. Tlp</th>
                                            <th>Project</th>
                                            <th>Jabatan</th>
                                            <th>No. Order</th>
                                            <th>Status Komplain</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("select id, nama, no_tlp, proyek, jabatan, no_order, date, status_komplin from email WHERE user_id = '$get[oId]' ORDER BY date DESC limit 0,5");
                                        $total = mysql_num_rows($query);
                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            echo"<tr>
                                                    <td>$no</td>";
                                            if ($get['uName'] == 'admin' || $get['uName'] == 'lani' || $get['uName'] == 'yesi') {
//                                                echo "<td><a href= 'index.php?pic=checkdata&page=update&id=$result[id]' class='btn btn-info'> Edit</a></td>";
//                                                echo "<td>$result[flag]</td>";
                                            }
                                            $status = ($result['status_komplin'] === '1' ? 'Sukses' : 'Proses');
                                            echo "    
                                                    <td>$result[date]</td>    
                                                    <td>$result[nama]</td>
                                                    <td>$result[no_tlp]</td>
                                                    <td>$result[proyek]</td>
                                                    <td>$result[jabatan]</td>
                                                    <td>$result[no_order]</td>
                                                    <td>$status</td>
                                                    </tr>";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}