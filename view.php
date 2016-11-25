<?php
session_start();
$get = $_SESSION;
if (empty($get['uName'])) {
    header('Location: index.html');
}
//connection
include_once("./jqgrid/config.php");

//get library
include(PHPGRID_LIBPATH . "inc/jqgrid_dist.php");

//get session
$get = $_SESSION;

//redirect page when session timeout
if (empty($get['uName'])) {
    header('Location: index.html');
}

if ($get['posID'] == '1') {
    $bool = true;
} else {
    $bool = FALSE;
}

//get connection
$db_conf = array(
    "type" => PHPGRID_DBTYPE,
    "server" => PHPGRID_DBHOST,
    "user" => PHPGRID_DBUSER,
    "password" => PHPGRID_DBPASS,
    "database" => PHPGRID_DBNAME
);

$g = new jqgrid($db_conf);

//set table jqgrid
$opt = array();
$opt["rowNum"] = 20;
$opt["sortname"] = 'id';
$opt["sortorder"] = "desc";
$opt["caption"] = "Check Data";
$opt["autowidth"] = true;
$opt["multiselect"] = $bool;
$opt["altRows"] = true;
$opt["altclass"] = "myAltRowClass";
$opt["rownumbers"] = true;
$opt["shrinkToFit"] = FALSE;
$opt["rowactions"] = $bool;
$opt["export"] = array("format" => "pdf", "filename" => "my-file", "sheetname" => "test");

$g->set_options($opt);

//setting action add, edit, delete, filter, export, filter, search
$g->set_actions(array(
    "add" => FALSE,
    "edit" => $bool,
    "delete" => $bool,
    "rowactions" => true,
    "showhidecolumns" => true,
    "export" => FALSE,
    "autofilter" => true,
    "search" => "single"
        )
);

//query
$g->select_command = "SELECT * FROM purchasing";

//get table
$g->table = "purchasing";

//index id
$col = array();
$col["title"] = "Id";
$col["name"] = "id";
$col["editable"] = false; // this column is not editable
$col["align"] = "center";
$col["hidden"] = true;
$cols[] = $col;

//get user role 
$qPermis = "select DISTINCT checkdata, employee, users, complain, project, "
        . "warehouse, workshop, `reset`, `add`, `delete`, download, print, price, "
        . "flag, proses1, proses2 from permission where id_user = $get[oId]";
$rPermis = mysql_query($qPermis);
$dataPermis = mysql_fetch_array($rPermis);

if ($dataPermis['flag'] == '1') {
    $col = array();
    $col["title"] = "Flag";
    $col["name"] = "flag";
    $col["align"] = "center";
    $col["editable"] = true;
    $col["width"] = "100";
    $cols[] = $col;
}

$col = array();
$col["title"] = "Date Order";
$col["name"] = "tanggal_order";
$col["dbname"] = "LOWER(tanggal_order)";
$col["formatter"] = "date";
$col["formatoptions"] = array("srcformat" => 'Y-m-d', "newformat" => 'd M Y');
$col["editable"] = true;
$col["align"] = "center";
$col["width"] = "100";
$cols[] = $col;

$col = array();
$col["title"] = "SMS No.";
$col["name"] = "no_sms";
$col["sortable"] = false;
$col["search"] = true;
$col["editable"] = TRUE;
$col["align"] = "center";
$col["width"] = "85";
if ($dataPermis['print'] == '1') {
    $col["link"] = "http://orderkantor.com/index.php?pic=checkdata&page=print&id={no_sms}";
}
$cols[] = $col;

$col = array();
$col["title"] = "Buyer";
$col["name"] = "pemesan";
$col["editable"] = true;
if ($dataPermis['proses1'] == '1') {
    $col["link"] = "http://orderkantor.com/index.php?pic=checkdata&page=update&id={id}";
}
$cols[] = $col;

$col = array();
$col["title"] = "Project";
$col["name"] = "nama_proyek";
$col["editable"] = true;
//$col["width"] = "375";
$cols[] = $col;

$col = array();
$col["title"] = "item";
$col["name"] = "item";
$col["editable"] = true;
$col["width"] = "500";
$cols[] = $col;

$col = array();
$col["title"] = "Qty";
$col["name"] = "qty";
$col["editable"] = true;
$col["width"] = "100";
$cols[] = $col;

$col = array();
$col["title"] = "Unit";
$col["name"] = "satuan";
$col["editable"] = true;
$col["width"] = "100";
$cols[] = $col;

$col = array();
$col["title"] = "Request Delivery";
$col["name"] = "request";
$col["editable"] = true;
$col["width"] = "100";
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "Date Process";
$col["name"] = "tanggal_proses";
$col["datefmt"] = "j F Y";
$col["formatter"] = "date";
$col["formatoptions"] = array("srcformat" => 'Y-m-d', "newformat" => 'd M Y');
$col["editable"] = true;
$col["width"] = "100";
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "PO No.";
$col["name"] = "no_po";
$col["editable"] = true;
$col["align"] = "center";
$col["width"] = "75";
$cols[] = $col;

$col = array();
$col["title"] = "Vendor";
$col["name"] = "vendor";
$col["editable"] = true;
$col["width"] = "125";
$cols[] = $col;

$col = array();
$col["title"] = "Shipping Estimate";
$col["name"] = "estimasi";
$col["editable"] = true;
$col["width"] = "115";
$cols[] = $col;

$col = array();
$col["title"] = "CP";
$col["name"] = "cp";
$col["editable"] = true;
$col["width"] = "55";
$cols[] = $col;

if ($dataPermis['price'] == '1') {
    $col = array();
    $col["title"] = "Price";
    $col["name"] = "harga";
    $col["editable"] = true;
    $col["width"] = "115";
    $col["align"] = "center";
    $cols[] = $col;
}
$g->set_columns($cols);

$out = $g->render("list1");
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Warehouse</title>
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>-->
        <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">
        <link rel="shortcut icon" href="assets/ico/warehouse.png">
        <link rel="stylesheet" href="css/dataTables.bootstrap.css">
        <script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>

        <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
        <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">

        <!--jquery-->
        <link rel="stylesheet" type="text/css" media="screen" href="jqgrid/lib/js/themes/redmond/jquery-ui.custom.css"></link>	
        <link rel="stylesheet" type="text/css" media="screen" href="jqgrid/lib/js/jqgrid/css/ui.jqgrid.css"></link>	

        <script src="jqgrid/lib/js/jquery.min.js" type="text/javascript"></script>
        <script src="jqgrid/lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
        <script src="jqgrid/lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
        <script src="jqgrid/lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
        <!--end jquery-->
        <style>
            .main-content{
                margin-top: -60px;
            }
            #gbox_list1{
                margin-top: -13px;
            }
            #line-chart {
                height:300px;
                width:800px;
                margin: 0px auto;
                margin-top: 1em;
            }
            .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
                color: #fff;
            }
            .content .header{
                border-bottom: 1px cccccc;
                border-bottom: 1px #eee;
            }
        </style>
    </head>
    <body class=" theme-blue" style="overflow: hidden;">

        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="index.php"><span class="navbar-brand"><span class="fa fa-home"></span> Warehouse  Information System</span></a></div>

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
                }if ($complain == '1') {
                    $emp = '<li ><a href="index.php?pic=complain&page=view"><span class="fa fa-caret-right"></span> Complain</a></li> ';
                }if ($employee == '1') {
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
            <div class="header">
                <h1 class="page-title">Check Data</h1>
                <ul class="breadcrumb">
                    <li>Home </li>
                    <li class="active">Check Data</li>
                </ul>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class = "btn-toolbar list-toolbar">
                            <br/>
                            <?php
                            $add = $dataPermis['add'];
                            $download = $dataPermis['download'];
                            if ($add == '1') {
                                $create = '<a href="index.php?pic=checkdata&page=create" class="btn btn-success"><span class="fa fa-plus"></span> Tambah</a> ';
                            } if ($download == '1') {
                                $donlod = '<a href="download.php" class="btn btn-warning"><span class="fa fa-download"></span> Download</a> ';
                            }
                            echo $create;
                            echo $donlod;
                            ?>
                        </div>
                        <?php
                        echo $out
                        ?>
                    </div>
                </div>
            </div>

            <?php
            include './footer.php';
            ?>
        </div>

        <!--<script src="lib/bootstrap/js/bootstrap.js"></script>-->
    <!--<script src="js/jquery-1.11.1.min.js"></script>-->
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

        </script>
    </body>
</html>