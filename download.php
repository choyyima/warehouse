<?php
session_start();
include "config.php";
include "./function.php";
$get = $_SESSION;
if (empty($get['uName'])) {
    header('Location: index.html');
}

$qPermis = "select DISTINCT checkdata, employee, users, complain, project, "
        . "warehouse, workshop, `reset`, `add`, `delete`, download, print, price, "
        . "flag, proses1, proses2 from permission where id_user = $get[oId]";
$rPermis = mysql_query($qPermis);
$dataPermis = mysql_fetch_array($rPermis);
?>
<!doctype html>
<html lang="en"><head>
        <meta charset="utf-8">
        <title>Procurement Information Center</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
        <link href="css/jquery.dataTables.css" rel="stylesheet" type="css">
        <link href="css/buttons.dataTables.min.css" rel="stylesheet" type="css">
        <link href="css/select2.min.css" rel="stylesheet" />
                <!--<script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>-->

        <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
        <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">
        <style>
            #data_wrapper{
                overflow-x: auto;
            }
            .dataTables_filter{
                // visibility: hidden;
            }
        </style>
    </head>
    <body class=" theme-blue">

        <!-- Demo page code -->

        <style type="text/css">
            #line-chart {
                height:300px;
                width:800px;
                margin: 0px auto;
                margin-top: 1em;
            }
            .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
                color: #fff;
            }
        </style>

        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="index.php"><span class="navbar-brand"><span class="fa fa-paper-plane"></span> Procurement  Information Center</span></a></div>

            <div class="navbar-collapse collapse" style="height: 1px;">
                <ul id="main-menu" class="nav navbar-nav navbar-right">
                    <li class="dropdown hidden-xs">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?php echo $get['uName']; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="sidebar-nav">
            <ul>
                <li>
                    <a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse">
                        <i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i>
                    </a>
                </li>
                <?php
                $checkdata = $dataPermis['checkdata'];
                $employee = $dataPermis['employee'];
                $complain = $dataPermis['complain'];
                $users = $dataPermis['users'];
                $project = $dataPermis['project'];
                $warehouse = $dataPermis['warehouse'];
                $workshop = $dataPermis['workshop'];
                $reset = $dataPermis['reset'];

                if ($checkdata == '1') {
                    $view = '<li ><a href="view.php"><span class="fa fa-caret-right"></span> Check Data </a></li>';
                }if ($employee == '1') {
                    $emp = '<li ><a href="index.php?pic=complain&page=view"><span class="fa fa-caret-right"></span> Complain</a></li> ';
                }if ($complain == '1') {
                    $com = '<li ><a href="index.php?pic=pm&page=view"><span class="fa fa-caret-right"></span> Employee</a></li>';
                }if ($users == '1') {
                    $usr = '<li ><a href="index.php?pic=user&page=view"><span class="fa fa-caret-right"></span> Users</a></li>';
                }if ($project == '1') {
                    $prj = ' <li ><a href="index.php?pic=project&page=view"><span class="fa fa-caret-right"></span> Project </a></li>';
                }if ($warehouse == '1') {
                    $wrh = '<li ><a href="index.php?pic=warehouse&page=view"><span class="fa fa-caret-right"></span> Warehouse </a></li>';
                }if ($workshop == '1') {
                    $wrk = '<li ><a href="index.php?pic=workshop&page=view"><span class="fa fa-caret-right"></span> Workshop </a></li>';
                }if ($reset == '1') {
                    $res = '<li ><a href="index.php?pic=reset&page=view"><span class="fa fa-caret-right"></span> Reset Password</a></li>';
                }

                if ($project == '1' || $warehouse == '1' || $workshop == '1') {
                    $menu = '<li><a href="#" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase "></i> Account <i class="fa fa-collapse"></i></a></li>';
                }
                ?>
                <li> 
                    <ul class="dashboard-menu nav nav-list collapse in">
                        <?php
                        echo $view;
                        echo $emp;
                        echo $com;
                        echo $usr;
                        ?>
                    </ul>
                </li>                
                <li><a href="#" data-target=".master-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-file "></i> Master <i class="fa fa-collapse"></i></a></li>
                <li>
                    <ul class="master-menu nav nav-list collapse in">
                        <?php
                        echo $prj;
                        echo $wrh;
                        echo $wrk;
                        ?>               
                    </ul>
                </li>                
                <?php echo $menu; ?>
                <li>
                    <ul class="accounts-menu nav nav-list collapse in">
                        <?php echo $res; ?>
                        <li ><a href="sign-out.php"><span class="fa fa-caret-right"></span> Logout</a></li> 
                    </ul>
                </li>
            </ul>
        </div>
        <div class="content">
            <?php
            $date_start = begin_date_month();
            $date_end = last_date_month();
            ?> 
            <div class="header">
                <h1 class="page-title">Download Data</h1>
                <ul class="breadcrumb">
                    <li>Home </li>
                    <li class="active">Download Data</li>
                </ul>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default" style="border-color: #337ab7;">
                            <a href="#" class="panel-heading" data-toggle="collapse" style="background: #337ab7; border-color: #337ab7; color: white;"> Filter</a>
                            <div id="widget1container" class="panel-body">
                                <div class="box-body table-responsive">
                                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>First Date / Tanggal Awal</label>
                                                <input type="date" name="date1" class="form-control" value="<?php echo $date_start; ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>End Date / Tanggal Akhir</label>
                                                <input type="date" name="date2" class="form-control" value="<?php echo $date_end; ?>" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Flag / Bendera</label>
                                                <select name="flag" class="form-control js-example-basic-single">
                                                    <option value="ALL">All</option>
                                                    <?php
                                                    $qFl = mysql_query("select DISTINCT(flag) bendera from purchasing");
                                                    while ($dataFl = mysql_fetch_array($qFl)) {
                                                        ?>
                                                        <option value="<?php echo $dataFl['bendera']; ?>"><?php echo $dataFl['bendera']; ?></option>
                                                    <?php }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Project / Proyek</label>
                                                <select name="project" class="form-control js-example-basic-single">
                                                    <option value="ALL">All</option>
                                                    <?php
                                                    $qPro = mysql_query("select DISTINCT(nama_proyek) project from purchasing");
                                                    while ($dataPro = mysql_fetch_array($qPro)) {
                                                        ?>
                                                        <option value="<?php echo $dataPro['project'] ?>"><?php echo $dataPro['project'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Supplier / Vendor</label>
                                                <select name="supplier" class="form-control js-example-basic-single">
                                                    <option value="ALL">All</option>
                                                    <?php
                                                    $qSup = mysql_query("select DISTINCT(vendor)supplier  from purchasing");
                                                    while ($dataSup = mysql_fetch_array($qSup)) {
                                                        ?>
                                                        <option value="<?php echo $dataSup['supplier'] ?>"><?php echo $dataSup['supplier'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Item / Bahan</label>
                                                <select name="item" class="form-control js-example-basic-single">
                                                    <option value="ALL">All</option>
                                                    <?php
                                                    $qITE = mysql_query("select DISTINCT(item)bahan from purchasing");
                                                    while ($dataITE = mysql_fetch_array($qITE)) {
                                                        ?>
                                                        <option value="<?php echo $dataITE['bahan'] ?>"><?php echo $dataITE['bahan'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">    
                                            <div class="form-group">
                                                <button class="btn btn-primary" name="search" type="submit"><span class="fa fa-search"></span> Search</button>
                                                <a href="./index.php?pic=checkdata&page=view" class="btn btn-default" > Back</a>                                                
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['search'])) {
                        $date1 = $_POST['date1'];
                        $date2 = $_POST['date2'];
                        $flag = $_POST['flag'];
                        $item = $_POST['item'];
                        $supplier = $_POST['supplier'];
                        $project = $_POST['project'];

                        $sqlFilter = "select * from purchasing where tanggal_order >= '$date1' and tanggal_order <= '$date2'";
                        if ($flag != "" && $flag != "ALL") {
                            $sqlFilter .= " and flag ='$flag' ";
                        }
                        if ($item != "" && $item != "ALL") {
                            $sqlFilter .= " and item ='$item' ";
                        }
                        if ($supplier != "" && $supplier != "ALL") {
                            $sqlFilter .= " and vendor ='$supplier' ";
                        }
                        if ($project != "" && $project != "ALL") {
                            $sqlFilter .= " and nama_proyek ='$project' ";
                        }

                        $resulfFilter = mysql_query($sqlFilter);

                        $filter = mysql_num_rows($resulfFilter);
                        if ($filter > 0) {
                            ?>
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <a href="#" class="panel-heading" data-toggle="collapse"> Check Data</a>
                                    <div id="widget1container" class="panel-body">
                                        <div class="box-body table-responsive"> 
                                            <style>
                                                #data_filter, #data_length, #data_info, #data_paginate {
                                                    visibility: hidden;
                                                }
                                            </style>
                                            <table id="data" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="30px">No.</th>
                                                        <th>Flag</th>
                                                        <th width="80px">Date Order</th>
                                                        <th>SMS No. </th>
                                                        <th>Buyer</th>
                                                        <th>Project</th>
                                                        <th>Item</th>
                                                        <th>Qty</th>
                                                        <th>Unit</th>
                                                        <th width="80px">Date Process</th>
                                                        <th>Request</th>
                                                        <th>PO No. </th>
                                                        <th>Vendor</th>
                                                        <th>Estimasi</th>
                                                        <th>Pengorder</th>
                                                        <th>Harga</th>
                                                        <th>PPN</th>
                                                        <th>Total</th>
                                                        <th>Subtotal</th>
                                                        <th>Tanggal Tempo</th>
                                                        <th>Tanggal Kirim</th>
                                                        <th>Contact Person</th>
                                                        <th>Surat Jalan</th>
                                                        <th>Recipient</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    while ($result = mysql_fetch_array($resulfFilter)) {
                                                        echo"<tr>
                                                    <td>$no</td>
                                                    <td>$result[flag]</td>    
                                                    <td>$result[tanggal_order]</td>    
                                                    <td>$result[no_sms]</td>
                                                    <td>$result[pemesan]</td>
                                                    <td>$result[nama_proyek]</td>
                                                    <td>$result[item]</td>
                                                    <td>$result[qty]</td>
                                                    <td>$result[satuan]</td>
                                                    <td>$result[tanggal_proses]</td>    
                                                    <td>$result[request]</td>
                                                    <td>$result[no_po]</td>    
                                                    <td>$result[vendor]</td>    
                                                    <td>$result[estimasi]</td> 
                                                    <td>$result[pengorder]</td>
                                                    <td>$result[harga]</td>
                                                    <td>$result[ppn]</td>
                                                    <td>$result[total]</td>
                                                    <td>$result[subtotal]</td>
                                                    <td>$result[tanggal_tempo]</td>
                                                    <td>$result[tanggal_kirim]</td>
                                                    <td>$result[cp]</td>
                                                    <td>$result[surat_jalan]</td>
                                                    <td>$result[recipient]</td>
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
                        <?php } else {
                            ?>

                            <div class="col-lg-12">
                                <div class="alert alert-info">
                                    <center><h2>No Data!</h2></center>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php include './footer.php';
            ?>
        </div>

        <!--<script src="lib/bootstrap/js/bootstrap.js"></script>-->
        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
<!--        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.js"></script>
        <script src="js/jquery.numberformatter-1.2.3.js"></script> -->
        <!--<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>-->
        <script src="js/jquery.dataTables.minn.js"></script>
        <script src="js/dataTables.buttons.min.js"></script>
        <script src="js/buttons.flash.min.js"></script>
        <script src="js/jszip.min.js"></script>
        <script src="js/pdfmake.min.js"></script>
        <script src="js/vfs_fonts.js"></script>
        <script src="js/buttons.html5.min.js"></script>
        <script src="js/buttons.print.min.js"></script> 
        <script src="js/select2.min.js"></script>    
        <script type="text/javascript">
            $(function () {
                var match = document.cookie.match(new RegExp('color=([^;]+)'));
                if (match)
                    var color = match[1];
                if (color) {
                    $('body').removeClass(function (index, css) {
                        return (css.match(/\btheme-\S+/g) || []).join(' ');
                    });
                    $('body').addClass('theme-' + color);
                }

                $('[data-popover="true"]').popover({html: true});

                var uls = $('.sidebar-nav > ul > *').clone();
                uls.addClass('visible-xs');
                $('#main-menu').append(uls.clone());
            });
            $(document).ready(function () {
                $('#data').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'print'
                    ],
                    "lengthMenu": [[-1], ["All"]]
                });
                $(".js-example-basic-single").select2();
//                $( ".buttons-pdf" ).find('span').addClass('fa fa-file');
//                $( ".buttons-print" ).find('span').addClass('fa fa-print');
            });

//            $("[rel=tooltip]").tooltip();
//            $(function () {
//                $('.demo-cancel-click').click(function () {
//                    return false;
//                });
//            });


        </script>
    </body>
</html>