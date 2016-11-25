<?php
session_start();
include "config.php";
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
        <title>Warehouse</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!--<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">-->
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
        <link rel="shortcut icon" href="assets/ico/warehouse.png">
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
        <script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
        <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">
        <style>
            #data_wrapper{
                overflow-x: auto;
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
                <a class="" href="index.php"><span class="navbar-brand"><span class="fa fa-paper-plane"></span> Warehouse  Information System</span></a></div>

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
                    <a href="#" data-target=".master-menu" class="nav-header" data-toggle="collapse">
                        <i class="fa fa-fw fa-dashboard"></i> Master<i class="fa fa-collapse"></i>
                    </a>
                </li>
                <?php
//                $checkdata = $dataPermis['checkdata'];
//                $employee = $dataPermis['employee'];
//                $complain = $dataPermis['complain'];
//                $users = $dataPermis['users'];
//                $project = $dataPermis['project'];
//                $warehouse = $dataPermis['warehouse'];
//                $workshop = $dataPermis['workshop'];
//                $reset = $dataPermis['reset'];
//
//                if ($checkdata == '1') {
                $unt = '<li ><a href="index.php?wr=unit&page=view"><span class="fa fa-caret-right"></span> Item/Unit </a></li>';
//                }if ($complain == '1') {
                $loc = '<li ><a href="index.php?wr=location&page=view"><span class="fa fa-caret-right"></span> Location/Lokasi</a></li> ';
//                }if ($employee == '1') {
                $cat = '<li ><a href="index.php?wr=category&page=view"><span class="fa fa-caret-right"></span> Category/Kategori</a></li>';
//                }if ($users == '1') {
                $in = '<li ><a href="index.php?wr=stockin&page=view"><span class="fa fa-caret-right"></span> Stock In</a></li>';
//                }if ($project == '1') {
                $out = ' <li ><a href="index.php?wr=stockout&page=view"><span class="fa fa-caret-right"></span> Stock Out </a></li>';
//                }if ($warehouse == '1') {
//                    $wrh = '<li ><a href="index.php?wr=warehouse&page=view"><span class="fa fa-caret-right"></span> Report Stock In </a></li>';
//                }if ($workshop == '1') {
//                    $wrk = '<li ><a href="index.php?wr=workshop&page=view"><span class="fa fa-caret-right"></span> Report Stock Out </a></li>';
//                }if ($reset == '1') {
                $res = '<li ><a href="index.php?wr=reset&page=view"><span class="fa fa-caret-right"></span> Reset Password</a></li>';
//                }                    
                $usr = '<li ><a href="index.php?wr=user&page=view"><span class="fa fa-caret-right"></span> User</a></li>';

//                if ($project == '1' || $warehouse == '1' || $workshop == '1') {
                $menu = '';
//                }
                ?>
                <li> 
                    <ul class="master-menu nav nav-list collapse in">
                        <?php
                        echo $unt;
                        echo $loc;
                        echo $cat;
                        ?>
                    </ul>
                </li>                
                <li><a href="#" data-target=".transaksi-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-file "></i> Transaction <i class="fa fa-collapse"></i></a></li>
                <li>
                    <ul class="transaksi-menu nav nav-list collapse in">
                        <?php
                        echo $in;
                        echo $out;
                        ?>               
                    </ul>
                </li>                
                <li><a href="#" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase "></i> Account <i class="fa fa-collapse"></i></a></li>
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
            $g = $_GET['wr'];
            if (isset($g)) {
                if ($g == 'location') {
                    include 'lokasi.php';
                } elseif ($g == 'unit') {
                    include 'unit.php';
                } elseif ($g == 'category') {
                    include 'kategori.php';
                } elseif ($g == 'stockin') {
                    include 'stockin.php';
                } elseif ($g == 'stockout') {
                    include 'stockout.php';
                } elseif ($g == 'stockcard') {
                    include 'stockcard.php';
                } elseif ($g == 'user') {
                    include 'users.php';
                } elseif ($g == 'report') {
                    include 'report.php';
                } elseif ($g == 'download') {
                    include 'download.php';
                } elseif ($g == 'action') {
                    include 'action.php';
                } elseif ($g == 'workshop') {
                    include 'workshop.php';
                } elseif ($g == 'warehouse') {
                    include 'warehouse.php';
                } elseif ($g == 'reset') {
                    include './reset-password.php';
                }
            } else {
                echo "<script>javascript:window.location.replace('index.php?wr=unit&page=view');</script>";
            }
            include './footer.php';
            ?>
        </div>

        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap.js"></script>
        <script src="js/jquery.numberformatter-1.2.3.js"></script>        
        <script type="text/javascript">
            $(function () {
                var match = document.cookie.match(new RegExp('color=([^;]+)'));
                if (match)
                    var color = match[1];
                if (color) {
                    $('body').removeClass(function (index, css) {
                        return (css.match(/\btheme-\S+/g) || []).join(' ');
                    }),
                            $('body').addClass('theme-' + color);
                }

                $('[data-popover="true"]').popover({html: true});

                var uls = $('.sidebar-nav > ul > *').clone();
                uls.addClass('visible-xs');
                $('#main-menu').append(uls.clone());
                $('[data-toggle="tooltip"]').tooltip();
            });
            $(document).ready(function () {
                $('#data').dataTable({
                    "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]]
                });
            });
            
            $(".chosen").chosen();

//            $("[rel=tooltip]").tooltip();
//            $(function () {
//                $('.demo-cancel-click').click(function () {
//                    return false;
//                });
//            });


        </script>
    </body>
</html>