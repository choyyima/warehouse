<?php
include "config.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <div class="header">
            <h1 class="page-title">Stock Card</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Stock Card</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Stock Card</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <table class="example table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Barang</th>
                                            <th>Lokasi Simpan</th>
                                            <th>Masuk / In</th>
                                            <th>Keluar / Out</th>
                                            <th>Sisa</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" style="text-align:right">Total:</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("SELECT so.id, so.nama_barang, so.lokasi_simpan, so.jumlah, s.jumlah_diambil, (so.jumlah - s.jumlah_diambil) as sum 
                                                            FROM stockout s 
                                                            LEFT OUTER JOIN stockin so on so.id = s.id_stock_in");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            echo"<tr>
                                                <td>$no</td>    
                                                <td>$result[nama_barang]</td>    
                                                <td>$result[lokasi_simpan]</td>
                                                <td style=text-align:right>$result[jumlah]</td>
                                                <td style=text-align:right>$result[jumlah_diambil]</td>
                                                <td style=text-align:right>$result[sum]</td>
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
        <script src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.example').DataTable({
                    "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
                    "footerCallback": function (row, data, start, end, display) {
                        var api = this.api(), data;

                        // Remove the formatting to get integer data for summation
                        var intVal = function (i) {
                            return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '') * 1 :
                                    typeof i === 'number' ?
                                    i : 0;
                        };

                        // Total over all pages
                        total = api
                                .column(5)
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                        // Total over this page
                        pageTotal = api
                                .column(5, {page: 'current'})
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                        // Update footer
                        $(api.column(5).footer()).html(
                                '<p style="text-align:right">'+pageTotal + ' <br>(' + total + ' Subtotal)</p>'
                                );
                    }
                });
            });

        </script>
        <?php
    } elseif ($_GET['page'] === 'print') {
        $gets = $_GET;
        $id = $gets['id'];
        $sql = mysql_query("SELECT so.id, so.nama_barang, so.lokasi_simpan, DATE_FORMAT(so.tanggal_masuk,'%d %b %Y') tglmasuk, DATE_FORMAT(s.tanggal_keluar,'%d %b %Y') tglkeluar FROM stockout s 
                             LEFT OUTER JOIN stockin so on so.id = s.id_stock_in WHERE so.id='$id'");
//       echo $sql;die();
        $rows = mysql_fetch_array($sql);
        ?>
        <script type="text/javascript">
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
        <div class="main-content" id="print">

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-danger" onclick="printDiv('print');"><span class="fa fa-print"> Print</span></button>
                    <a href="view.php" class="btn btn-default"> Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h3 style="text-decoration: underline"><span class="fa fa-briefcase"></span> KARTU STOK BARANG / MESIN SIPIL</h3>
                        </div>
                        <div class="pull-left unstyled col-sm-6 col-md-6">
                            <p><strong>Nama Barang/Mesin : </strong><?php echo $rows['nama_barang']; ?></p>
                            <p><strong>Lokasi Simpan : </strong><?php echo $rows['lokasi_simpan']; ?></p>     
                        </div>
                    </div>
                    <div class="main-content">
                        <div class="row">       
                            <div class="col-sm-12 col-md-12">
                                <table class="table table-bordered table-responsive table-hover">
                                    <thead>
                                        <tr style="background-color: #efefef;">
                                            <th style="text-align: center" colspan="2">Tanggal</th>
                                            <th style="text-align: center" colspan="2">Jumlah</th>
                                            <th style="text-align: center" rowspan="2">Proyek Asal</th>
                                            <th style="text-align: center" rowspan="2">Tujuan</th>
                                            <th style="text-align: center" rowspan="2">Kondisi</th>
                                            <th style="text-align: center" rowspan="2">No. Surat Jalan</th>
                                        </tr>                                    
                                        <tr style="background-color: #efefef;">
                                            <th style="text-align: center">Masuk</th>
                                            <th style="text-align: center">Keluar</th>
                                            <th style="text-align: center">Masuk</th>
                                            <th style="text-align: center">Keluar</th>                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlStok = mysql_query("SELECT so.id, so.nama_barang, so.lokasi_simpan, so.asal_proyek, s.tujuan, DATE_FORMAT(so.tanggal_masuk,'%d %b %Y') tglmasuk, 
                                            so.jumlah,s.jumlah_diambil, so.kondisi,s.no_surat_jalan,
                                            DATE_FORMAT(s.tanggal_keluar,'%d %b %Y') tglkeluar FROM stockout s 
                                            LEFT OUTER JOIN stockin so on so.id = s.id_stock_in WHERE so.id='$id'");
                                        while ($rowStok = mysql_fetch_array($sqlStok)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $rowStok['tglmasuk']; ?></td>
                                                <td><?php echo $rowStok['tglkeluar']; ?></td>
                                                <td style="text-align: right;"><?php echo $rowStok['jumlah']; ?></td>
                                                <td style="text-align: right;"><?php echo $rowStok['jumlah_diambil']; ?></td>
                                                <td><?php echo $rowStok['asal_proyek']; ?></td>
                                                <td><?php echo $rowStok['tujuan']; ?></td>
                                                <td><?php echo $rowStok['kondisi']; ?></td>
                                                <td><?php echo $rowStok['no_surat_jalan']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr style="background-color: #337ab7; color: white">
                                            <td colspan="2">Jumlah </td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="5"></td>
                                        </tr>
                                        <tr style="background-color: #5cb85c; color: white">
                                            <td colspan="2">Stok </td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="5"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--</div>-->

                    <div class="row">
                        <div style="text-align: center;" class="unstyled col-sm-4">
                            <p>Dilaporkan Oleh,</p><br/>
                            <p>(______________)<br/><p><i>Sakur</i></p></p>     
                        </div>
                        <div style="text-align: center;" class="unstyled col-sm-4">
                            <p>Diperiksa Oleh,</p><br/>
                            <p>(______________)<br/><p><i>Ir. Rustam</i></p></p>     
                        </div>
                        <div style="text-align: center;" class="unstyled col-sm-4">
                            <p>Diterima Oleh,</p><br/>
                            <p>(______________)<p><i>Eries</i></p></p> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <?php
    }
}