<?php include './config.php'; ?>
<!doctype html>
<html lang="en"><head>
        <meta charset="utf-8">
        <title>Warehouse</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">-->
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
        <link rel="shortcut icon" href="assets/ico/warehouse.png">
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
        <!--<script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>-->
        <link href="css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
        <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">

        <!--<link rel="stylesheet" href="css/jquery-ui.css">-->
        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/jquery-ui.js"></script>
        <style>
            th { white-space: nowrap; }
        </style>
    </head>
    <body class=" theme-blue">

        <div id="container">
            <table id="example" class="display table" cellspacing="0" width="100%">                
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Lokasi Simpan</th>
                        <th>Jumlah</th>
                        <th>Diambil</th>
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
                    $query = mysql_query("SELECT so.id, so.nama_barang, so.lokasi_simpan, so.jumlah, s.jumlah_diambil, s.total FROM stockout s 
                                                    LEFT OUTER JOIN stockin so on so.id = s.id_stock_in");
                    $total = mysql_num_rows($query);

                    $no = 1;
                    while ($result = mysql_fetch_array($query)) {
                        echo"<tr>
                            <td>$no</td>    
                            <td>$result[nama_barang]</td>    
                            <td>$result[lokasi_simpan]</td>
                            <td>$result[jumlah]</td>
                            <td>$result[jumlah_diambil]</td>
                            <td>$result[total]</td>
                            </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.js"></script>
        <script src="js/jquery.numberformatter-1.2.3.js"></script>
        <script src="js/select2.min.js"></script> 
        <script type="text/javascript">
            $(document).ready(function () {
                $('#example').DataTable({
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
                                pageTotal + ' (' + total + ' Subtotal)'
                                );
                    }
                });
            });

        </script>
    </body>
</html>