<?php
session_start();
include "config.php";
$get = $_SESSION;
if (empty($get['uName'])) {
    header('Location: index.html');
}
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

        <script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>

        <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
        <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">

    </head>
    <body class=" theme-blue">

        <!-- Demo page code -->

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

            });
        </script>
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

        <script type="text/javascript">
            $(function () {
                var uls = $('.sidebar-nav > ul > *').clone();
                uls.addClass('visible-xs');
                $('#main-menu').append(uls.clone());
            });
        </script>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="../assets/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">


        <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
        <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
        <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
        <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
        <!--[if (gt IE 9)|!(IE)]><!--> 

        <!--<![endif]-->

        <div class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="checkdata.php"><span class="navbar-brand"><span class="fa fa-archive"></span> Procurement  Information Center</span></a></div>

            <div class="navbar-collapse collapse" style="height: 1px;">
                <ul id="main-menu" class="nav navbar-nav navbar-right">
                    <li class="dropdown hidden-xs">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?php echo $get['uName']; ?>
                            <!--<i class="fa fa-caret-down"></i>-->
                        </a>

                        <!--                        <ul class="dropdown-menu">
                                                    <li><a href="sign-out.php">Logout</a></li>
                                                </ul>-->
                    </li>
                </ul>

            </div>
        </div>
    </div>


    <div class="sidebar-nav">
        <ul>
            <li>
                <a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse">
                    <i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i>
                </a>
            </li>
            <li>
                <ul class=" nav nav-list collapse in">
                    <li class="active"><a href="checkdata.php"><span class="fa fa-caret-right"></span> Check Data </a></li> 
                    <li ><a href="complain.php"><span class="fa fa-caret-right"></span> Complain</a></li>   
                    <?php if ($get['uName'] == 'admin') { ?> 
                        <li ><a href="users.php"><span class="fa fa-caret-right"></span> Users</a></li>
                    <?php } ?>                 
                </ul>
            </li>
            <li><a href="#" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase "></i> Account <i class="fa fa-collapse"></i></a></li>
            <li>
                <ul class="accounts-menu nav nav-list collapse">
                    <li ><a href="reset-password.php"><span class="fa fa-caret-right"></span> Reset Password</a></li>
                    <li ><a href="sign-out.php"><span class="fa fa-caret-right"></span> Logout</a></li> 
                </ul>
            </li>

        </ul>
    </div>

    <div class="content">
        <div class="header">
            <h1 class="page-title">Update Data</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Update Data</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <?php
                    $gets = $_GET;
                    $id = $gets['id'];
                    $sql = mysql_query("Select * From purchasing where id = '$id'");
                    $rows = mysql_fetch_array($sql);
                    if ($get['uName'] == 'admin') {
                        $active = "";
                    } else if ($get['uName'] == 'lani') {
                        $active = "readonly";
                    }
                    ?>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="home">
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date Order / Tanggal Order</label>
                                        <input type="text" name="tanggal_order" value="<?php echo $rows['tanggal_order']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>No. SMS</label>
                                        <input type="text" name="no_sms" value="<?php echo $rows['no_sms']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Buyer / Pemesan</label>
                                        <input type="text" name="pemesan" value="<?php echo $rows['pemesan']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Flag</label>
                                        <input type="text" name="flag" value="<?php echo $rows['flag']; ?>" class="form-control" <?php echo $active; ?>>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Proyek</label>
                                        <input type="text" name="nama_proyek" value="<?php echo $rows['nama_proyek']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Item</label>
                                        <input type="text" name="item" value="<?php echo $rows['item']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="text" name="qty" value="<?php echo $rows['qty']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Unit / Satuan</label>
                                        <input type="text" name="satuan" value="<?php echo $rows['satuan']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Date Process / Tanggal Proses</label>
                                        <input type="text" name="tanggal_proses" value="<?php echo $rows['tanggal_proses']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>No. PO</label>
                                        <input type="text" name="no_po" value="<?php echo $rows['no_po']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Vendor / Supplier</label>
                                        <input type="text" name="vendor" value="<?php echo $rows['vendor']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Shipping Estimation / Estimasi Kirim</label>
                                        <input type="text" name="estimasi" value="<?php echo $rows['estimasi']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Person / Kontak</label>
                                        <input type="text" name="cp" value="<?php echo $rows['cp']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" name="save" type="submit"> Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <?php include './footer.php'; ?>
    </div>
</div>


<script src="lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
            $("[rel=tooltip]").tooltip();
            $(function () {
                $('.demo-cancel-click').click(function () {
                    return false;
                });
            });
</script>


</body></html>
<?php
if (isset($_POST['save'])) {
    $tgl_order = $_POST['tanggal_order'];
    $no_sms = $_POST['no_sms'];
    $pemesan = $_POST['pemesan'];
    $flag = $_POST['flag'];
    $nama_proyek = $_POST['nama_proyek'];
    $item = $_POST['item'];
    $qty = $_POST['qty'];
    $satuan = $_POST['satuan'];
    $tanggal_proses = $_POST['tanggal_proses'];
    $no_po = $_POST['no_po'];
    $vendor = $_POST['vendor'];
    $estimasi = $_POST['estimasi'];
    $cp = $_POST['cp'];
    $id = $gets['id'];

    $sql = "UPDATE `purchasing` SET "
            . "`tanggal_order`='$tgl_order', "
            . "`no_sms`='$no_sms', "
            . "`pemesan`='$pemesan', "
            . "`flag`='$flag', "
            . "`nama_proyek`='$nama_proyek', "
            . "`item`='$item', "
            . "`qty`='$qty', "
            . "`satuan`='$satuan', "
            . "`tanggal_proses`='$tanggal_proses', "
            . "`no_po`='$no_po', "
            . "`vendor`='$vendor', "
            . "`estimasi`='$estimasi', "
            . "`cp`='$cp' "
            . "WHERE (`id`='$id')";
    // echo $sql;
    // die();

    $result = mysql_query($sql);

    if ($result) {
        echo "<script>alert('Berhasil dirubah.')</script>";
        echo "<script type='text/javascript'>document.location='./checkdata.php'; </script>";
    } else {
        echo "<script>alert('Gagal! tidak dapat dirubah.')</script>";
    }
}