<?php
session_start();
/*
$pwd = $_GET['pwd'];
if($pwd !=='Password20160808'){
    echo 'Wrong password';die();
}
*/
include "config.php";


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
        <script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>

        <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
        <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">
        <style>
            #data_wrapper{
                overflow-x: auto;
            }
            .dataTables_filter{
                
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

        <?php 
            $total_outstanding_sms = 0;
            $total_outstanding_sms_item = 0;
            $conditional_query = ' no_po is null or length(no_po) = 0 ';
            
            $q = '
                SELECT count(1) res
                FROM (
                        select distinct 
                            no_sms 
                            ,case when created is null then now() when created = "0000-00-00 00:00:00" then now() else created end created
                            ,pemesan, no_po 
                        from purchasing

                ) tf
                where '.$conditional_query.'
                ORDER BY hour(timediff(now(),created)) desc, no_sms asc
            ';
            $query = mysql_query($q);
            while ($result = mysql_fetch_array($query)) {
                $total_outstanding_sms = $result[res];
            }
            
            $q = '
                SELECT count(1) res
                FROM (
                        select id 
                            ,no_sms 
                            ,case when created is null then now() when created = "0000-00-00 00:00:00" then now() else created end created
                            ,pemesan, no_po 
                        from purchasing

                ) tf
                where '.$conditional_query.'
                ORDER BY hour(timediff(now(),created)) desc, no_sms asc
            ';
            $query = mysql_query($q);
            while ($result = mysql_fetch_array($query)) {
                $total_outstanding_sms_item = $result[res];
            }
            
        ?>
        <div class="content" style="margin-left:0px">
            <div class="header">
                <h1 class="page-title" style="width:400px">SMS Monitoring - Outstanding</h1>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-3 col-md-3">
                    Total Outstanding SMS: <?php echo $total_outstanding_sms;?>
                    </div>
                    <div class="col-sm-3 col-md-3">
                    Total Outstanding SMS Item: <?php echo $total_outstanding_sms_item;?>
                    </div>
                </div>
                <br/>
                <div class="row">       
                    <div class="col-sm-12 col-md-12">
                        <div class="panel panel-default">
                            <a href="#widget1container" class="panel-heading" data-toggle="collapse"> SMS Monitoring - Outstanding</a>
                            <div id="widget1container" class="panel-body collapse in">
                                <div class="box-body table-responsive">
                                    <table id="data" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="30px">No.</th>
                                                <th>SMS No. </th>
                                                <th>Created Date</th>
                                                <th>Outstanding Time(in hours)</th>
                                                <th>Buyer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $dateMonNow =date('n');
                                            $dateMonAgo = new DateTime("-1 months");
                                            $MonAgo = $dateMonAgo->format("n");
                                            $q = '
                                                SELECT *
                                                        ,hour(timediff(now(),created)) outstanding_length
                                                FROM (
                                                        select distinct 
                                                            no_sms 
                                                            ,case when created is null then now() when created = "0000-00-00 00:00:00" then now() else created end created
                                                            ,pemesan, no_po 
                                                        from purchasing

                                                ) tf
                                                where '.$conditional_query.'
                                                ORDER BY hour(timediff(now(),created)) desc, no_sms asc
                                            ';
                                            $query = mysql_query($q);
                                            $total = mysql_num_rows($query);

                                            $no = 1;
                                            while ($result = mysql_fetch_array($query)) {
                                                echo"<tr>
                                                        <td>$no</td>
                                                        <td>$result[no_sms]</td>
                                                        <td>$result[created]</td>
                                                        <td>$result[outstanding_length]</td>
                                                        <td>$result[pemesan]</td>
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
            include './footer.php';
            ?>
        </div>

        <!--<script src="lib/bootstrap/js/bootstrap.js"></script>-->
        <script src="js/jquery-1.11.1.min.js"></script>
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
                        return (css.match(/\btheme-\S+/g) || []).join(' ')
                    })
                    $('body').addClass('theme-' + color);
                }

                $('[data-popover="true"]').popover({html: true});

                var uls = $('.sidebar-nav > ul > *').clone();
                uls.addClass('visible-xs');
                $('#main-menu').append(uls.clone());
            });
            $(document).ready(function () {
                $('#data').dataTable({
                    "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
                    "pageLength":-1,
                });
            });

//            $("[rel=tooltip]").tooltip();
//            $(function () {
//                $('.demo-cancel-click').click(function () {
//                    return false;
//                });
//            });

        setInterval(function() {
            window.location.reload();
          }, 300000);
        </script>
    </body>
</html>