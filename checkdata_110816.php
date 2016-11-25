<?php
include "config.php";
include "function.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
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
                    <?php
                    $getPosID = $get['posID'];
                    if ($getPosID == '1' || $getPosID == '3') {
                        ?>
                        <div class="btn-toolbar list-toolbar">
                            <a href="index.php?pic=checkdata&page=create" class="btn btn-success"><span class="fa fa-plus"></span> Tambah</a> 
                            <a href="download.php" class="btn btn-warning"><span class="fa fa-download"></span> Download</a> 
                        </div>
                    <?php } elseif ($getPosID == '5') { ?>                       
                        <div class="btn-toolbar list-toolbar">
                            <a href="index.php?pic=checkdata&page=create" class="btn btn-success"><span class="fa fa-plus"></span> Tambah</a> 
                        </div> 
                    <?php } elseif ($getPosID == '2') { ?>
                        <div class="btn-toolbar list-toolbar">
                            <a href="download.php" class="btn btn-warning"><span class="fa fa-download"></span> Download</a>  
                        </div> 
                    <?php } ?>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Check Data</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <table id="data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>
                                            <?php if ($getPosID == '1' || $getPosID == '3') { ?>
                                                <th></th>
                                                <th>Flag</th>
                                            <?php } elseif ($getPosID == '2') {
                                                ?>                                                
                                                <th>Flag</th>
                                            <?php } elseif ($getPosID == '5') { ?>
                                                <th></th>
                                            <?php }
                                            ?>
                                            <th width="80px">Date Order</th>
                                            <th>SMS No. </th>
                                            <th>Buyer</th>
                                            <th>Project</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th>Unit</th>
                                            <th width="80px">Date Process</th>
                                            <th>PO No. </th>
                                            <th>Vendor</th>
                                            <th>Shipping Estimate</th>
                                            <th>Contact Person</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $dateMonNow =date('n');
                                        $dateMonAgo = new DateTime("-1 months");
                                        $MonAgo = $dateMonAgo->format("n");

                                        $query = mysql_query("SELECT id,DATE_FORMAT(tanggal_order,'%d %b %Y') pesan,flag, no_sms, pemesan, nama_proyek, item, qty, satuan, DATE_FORMAT(tanggal_proses,'%d %b %Y') proses, no_po, vendor, DATE_FORMAT(estimasi,'%d %b %Y') kirim, cp FROM purchasing where MONTH(tanggal_order)>='$MonAgo' and MONTH(tanggal_order)<='$dateMonNow' ORDER BY tanggal_order DESC, no_sms DESC");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            echo"<tr>
                                                    <td>$no</td>";
                                            if ($getPosID == '1' || $getPosID == '3') {
                                                if ($result['no_po'] > 0) {
                                                    echo "<td><a href= 'index.php?pic=checkdata&page=checkout&id=$result[id]' class='btn btn-link'> Edit</a>";
                                                } else {
                                                    echo "<td><a href= 'index.php?pic=checkdata&page=update&id=$result[id]' class='btn btn-link'> Edit</a>";
                                                }
                                                echo "<a href= 'index.php?pic=checkdata&page=print&id=$result[no_sms]' class='btn btn-link'> Print</a></td>";
                                                echo "<td>$result[flag]</td>";
                                            } else if ($getPosID == '2') {
                                                echo "<td>$result[flag]</td>";
                                            } else if ($getPosID == '5') {
                                                echo "<td><a href= 'index.php?pic=checkdata&page=print&id=$result[no_sms]' class='btn btn-link'> Print</a></td>";
                                            }
                                            echo "    
                                                    <td>$result[pesan]</td>    
                                                    <td>$result[no_sms]</td>
                                                    <td>$result[pemesan]</td>
                                                    <td>$result[nama_proyek]</td>
                                                    <td>$result[item]</td>
                                                    <td>$result[qty]</td>
                                                    <td>$result[satuan]</td>
                                                    <td>$result[proses]</td>    
                                                    <td>$result[no_po]</td>
                                                    <td>$result[vendor]</td>    
                                                    <td>$result[kirim]</td> 
                                                    <td>$result[cp]</td>
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
    } elseif ($_GET['page'] === "create") {
        $q = "SELECT no_sms FROM purchasing ORDER BY tanggal_order DESC, no_sms DESC";
        $resultData = mysql_query($q);
        $getData = mysql_fetch_array($resultData);
        ?>

        <script src="coba.js"></script>
        <div class="header">
            <h1 class="page-title">Create Data</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Create Data</li>
            </ul>
        </div>
        <div class="main-content">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#procces1" data-toggle="tab">Process 1</a></li>
                <div class="pull-right col-lg-4">
                    <label>Last SMS Number/ No. SMS Terakhir : <?php echo $getData['no_sms'] ?></label>
                </div> 
            </ul>
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <br/>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data SMS Center</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <div class="tab-pane active in" id="procces1">
                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post" id="tab">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>SMS Number / No. SMS</label>
                                                <input type="text" name="no_sms" class="form-control" required="">
                                            </div>
                                        </div>       
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Date Order / Tanggal Order</label>
                                                <input type="date" name="tanggal_order" value="<?php echo date("Y-m-d"); ?>" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Time / Jam SMS</label>
                                                <input type="text" name="jam_sms" class="form-control" required="">
                                            </div>
                                        </div>                                     
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Buyer / Pemesan</label>
                                                <input type="text" name="pemesan" class="form-control" required="">
                                            </div>
                                        </div>                                    
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Project Name / Nama Proyek</label>
                                                <input type="text" name="nama_proyek" value="" class="form-control" required="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12">
                                            <div class="panel panel-default" style="border-color: #337ab7;">
                                                <a href="#widget1container" class="panel-heading" data-toggle="collapse" style="background: #337ab7; border-color: #337ab7; color: white;"> Order Detail / Daftar Pesanan</a>
                                                <div id="widget1container" class="panel-body collapse in">
                                                    <button class="btn btn-primary" id="add" type="button" ><span class="fa fa-plus"></span> </button> 
                                                    <button class="btn btn-danger" id="delete" type="button" ><span class="fa fa-trash-o"></span></button>
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th class="col-xs-1">#</th>
                                                                <th>Item</th>
                                                                <th class="col-lg-2">Qty</th>
                                                                <th class="col-lg-2">Unit</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="addProduct">
                                                            <tr id="first" style="display:none">
                                                                <td><input type="checkbox" class="checkbox"/></td>
                                                                <td><input name="item[]" type="text" class="form-control" required=""/></td>
                                                                <td><input name="qty[]"  type="text" class="form-control col-lg-4" required=""</td>
                                                                <td><input name="unit[]" type="text" class="form-control" required=""/></td>
                                                            </tr>
                                                            <tr id="empty"><td colspan="5" class="sys_align_center" >No Data / Tidak ada data</td></tr>
                                                        </tbody>
                                                    </table>

                                                    <div class="col-lg-12 well panel panel-primary">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label>Request Delivery / Permintaan Pengiriman</label>
                                                                <div class="form-inline"><input type="radio" name="radioreq" id="radiorequest"> <input type="date" name="request" id="request" class="form-control"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label></label>
                                                                <div class="form-inline"><input type="radio" id="request" name="radioreq" value="Beli dilapangan"> Beli Dilapangan</div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <label>Notes / Catatan</label>
                                                    <textarea name="notes" rows="2" class="form-control"></textarea>
                                                </div>  
                                            </div>
                                        </div>
                                        <div class="col-lg-4">                                        
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status_pic" class="form-control">
                                                    <option value="Waiting For Quotation">Waiting For Quotation</option>
                                                    <option value="Waiting Approval Director">Waiting Approval Director</option>
                                                    <option value="PO Has Been Release">PO Has Been Release</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">    
                                            <div class="form-group">
                                                <!--<a href="#myModal" class="btn btn-primary" data-toggle="modal"> Submit</a>-->
                                                <button type="submit" onClick="return confirm('Are you sure to submit the data? You will not allowed to edit the submitted data later');" class="btn btn-primary" name="saveadd">Submit</button>
                                                <a href="./index.php?pic=checkdata&page=view" class="btn btn-default" > Back</a>
                                                <input type="hidden" name="counter" id="counter">
                                                <input type="hidden" name="reqdata" id="reqdata">
                                            </div>
                                        </div>


                                        <!--                                        <div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                                    <div class="modal-dialog">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                                                                                                <h3 id="myModalLabel">Submit Confirmation</h3>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                onClick="return confirm('Are you sure to submit the data? You will not allowed to edit the submitted data later');"
                                                                                                <p class="error-text"><i class="fa fa-warning modal-icon"></i>Are you sure to submit the data?<br> You will not allowed to edit the submitted data later</p>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button class="btn btn-default" data-dismiss="modal" type="submit" aria-hidden="true">No</button>
                                                                                                <a class="btn btn-danger" data-dismiss="modal" name="saveadd" type="submit">Yes</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $('input[name=radioreq]').change(function () {
                    var dt;
                    dt = $('input[name="radioreq"]:checked').val();
                    $('#reqdata').val(dt);
                    //                    $("valreq").val(dt);
                    //                            alert(dt);
                });

                $("#request").change(function () {
                    var dta;
                    dta = $("#request").val();
                    $('#reqdata').val(dta);
                    //                    $("valreq").val(dt);
                    //                            alert(dt);
                });

            </script>

            <?php
            if (isset($_POST['saveadd'])) {
                $tgl_order = $_POST['tanggal_order'];
                $jam_sms = $_POST['jam_sms'];
                $no_sms = $_POST['no_sms'];
                $pemesan = $_POST['pemesan'];
                $nama_proyek = $_POST['nama_proyek'];
                $item = $_REQUEST['item'];
                $qty = $_REQUEST['qty'];
                $unit = $_REQUEST['unit'];
                $notes = $_POST['notes'];
                $reqs = $_POST['reqdata'];
                $status_pic = $_POST['status_pic'];
                $datenow = date("Y-m-d h:i:s");
                $cnt = $_POST['counter'];
                for ($i = 0; $i < $cnt; $i++) {
                    $sql = "insert into `purchasing` SET "
                            . "`tanggal_order`='$tgl_order', "
                            . "`no_sms`='$no_sms', "
                            . "`jam_sms`='$jam_sms', "
                            . "`pemesan`='$pemesan', "
                            . "`nama_proyek`='$nama_proyek', "
                            . "`item`='$item[$i]', "
                            . "`qty`='$qty[$i]', "
                            . "`satuan`='$unit[$i]', "
                            . "`notes`='$notes', "
                            . "`request`='$reqs', "
                            . "`status_pic`='$status_pic', "
                            . "`createdby`='$get[uName]', "
                            . "`created`='$datenow' ";
                            
                    $resultq = mysql_query($sql);
                    $newid = mysql_insert_id();
                }
                if ($resultq) {
                    echo "<script>alert('Berhasil ditambah.')</script>";
                    echo "<script type='text/javascript'>document.location='./index.php?pic=checkdata&page=print&id=$no_sms'; </script>";
                } else {
                    echo "<script>alert('Gagal! tidak dapat ditambah.')</script>";
                }
            }
        } elseif ($_GET['page'] === "update") {
            ?>

            <div class="header">
                <h1 class="page-title">Update Data</h1>
                <ul class="breadcrumb">
                    <li>Home </li>
                    <li class="active">Update Data</li>
                </ul>
            </div>
            <div class="main-content">
                <ul class="nav nav-tabs">
                    <li><a href="#procces1" data-toggle="tab">Process 1</a></li>
                    <li class="active"><a href="#procces2" data-toggle="tab">Process 2</a></li>
                </ul>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <?php
                        $gets = $_GET;
                        $checkeds = "";
                        $id = $gets['id'];
                        $sql = mysql_query("Select * From purchasing where id = '$id'");
                        $rows = mysql_fetch_array($sql);
                        if ($rows['status_pic'] == 'Waiting For Quotation') {
                            $checked = 'selected';
                        } elseif ($rows['status_pic'] == 'Waiting Approval Director') {
                            $checkeds = 'selected';
                        } elseif ($rows['status_pic'] == 'PO Has Been Release') {
                            $checkedss = 'selected';
                        }
                        
                        if($get['posID'] == '1'){
                        $readonly = "";
                        }else{
                        $readonly = "readonly";
                        }
                        ?>
                        <br/>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade" id="procces1">
                                <div class="panel panel-default">
                                    <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data SMS Center - Phase 1</a>
                                    <div id="widget1container" class="panel-body collapse in">
                                        <div class="box-body table-responsive">
                                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post" id="tab">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>SMS Number / No. SMS</label>
                                                        <input type="text" name="no_sms" value="<?php echo $rows['no_sms']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>       
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Date Order / Tanggal Order</label>
                                                        <input type="date" name="tanggal_order" value="<?php echo $rows['tanggal_order']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Time / Jam SMS</label>
                                                        <input type="text" name="jam_sms" value="<?php echo $rows['jam_sms']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>                                              
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Buyer / Pemesan</label>
                                                        <input type="text" name="pemesan" value="<?php echo $rows['pemesan']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>                                    
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Nama Proyek</label>
                                                        <input type="text" name="nama_proyek" value="<?php echo $rows['nama_proyek']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 well panel panel-primary">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Request Delivery / Permintaan Pengiriman</label>
                                                            <div class="form-inline">
                                                                <?php echo $rows['request']; ?>
                                                                <!--<input type="radio" name="radioreq" id="radiorequest" <?php echo $readonly; ?>> <input type="date" name="request" id="request" class="form-control" <?php echo $readonly; ?>>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="col-lg-4">
                                                                                                            <div class="form-group">
                                                                                                                <label></label>
                                                                                                                <div class="form-inline"><input type="radio" id="request" name="radioreq" value="BL" <?php echo $readonly; ?>> Beli Dilapangan</div>
                                                                                                            </div>
                                                                                                        </div>-->
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Notes / Catatan</label>
                                                            <textarea name="notes" rows="2" class="form-control" disabled=""><?php echo $rows['notes']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">                                        
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status_pic" class="form-control" disabled="">
                                                            <option value="Waiting For Quotation" <?php echo $checked; ?>>Waiting For Quotation</option>
                                                            <option value="Waiting Approval Director" <?php echo $checkeds; ?>>Waiting Approval Director</option>
                                                            <option value="PO Has Been Release" <?php echo $checkedss; ?>>PO Has Been Release</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane active in" id="procces2">
                                <div class="panel panel-default">
                                    <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data Purchase Order - Phase 2</a>
                                    <div id="widget1container" class="panel-body collapse in">
                                        <div class="box-body table-responsive">
                                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="forms" method="post" id="tab2">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default" style="border-color: #337ab7;">
                                                        <a href="#widget1container" class="panel-heading" data-toggle="collapse" style="background: #337ab7; border-color: #337ab7; color: white;"> Order</a>
                                                        <style>
                                                            #data_filter, #data_length, #data_info, #data_paginate {
                                                                visibility: hidden;
                                                            }
                                                        </style>
                                                        <table id="data" class=" table table-bordered table-striped table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th class="col-xs-0">No.</th>
                                                                    <th class="col-xs-2">PO Number / No. PO</th>
                                                                    <th class="col-xs-2">Date PO / Tanggal PO</th>
                                                                    <th class="col-xs-2">Flag / Bendera</th>
                                                                    <th class="col-xs-2">Vendor/ Supplier</th>
                                                                    <th class="col-xs-2">Buyer / Pemesan</th>
                                                                    <th class="col-xs-2">Estimation Date / Estimasi Kirim</th>
                                                                    <th class="col-xs-1">Contact Person / Kontak </th>
                                                                    <th class="col-xs-2">Term Of Date / Jatuh Tempo</th>
                                                                    <th class="col-lg-3">Item</th>
                                                                    <th class="col-xs-2">Qty</th>
                                                                    <th class="col-xs-2">Unit</th>
                                                                    <th class="col-xs-2">Unit Price / Harga Satuan</th>
                                                                    <th class="col-xs-0">PPN 10%</th>
                                                                    <th class="col-xs-1">Unit Price Final / Total</th>
                                                                   <!-- <th class="col-xs-1">Total Price Final / Total Harga * Qty</th>-->
                                                                </tr>
                                                            </thead>
                                                            <tbody id="addProduct">
                                                                <?php
//                                                            $dates = new DateTime('+1 day');
                                                                $no = 1;
                                                                $dataPO = mysql_query("select * from purchasing where id='$id'");
                                                                while ($arrPO = mysql_fetch_array($dataPO)) {
                                                                    if ($arrPO['ppn'] == "Yes") {
                                                                        $cek = "selected";
                                                                    } else {
                                                                        $ceks = "selected";
                                                                    }
                                                                    if (!empty($arrPO)) {
                                                                        ?>
                                                                        <tr>
                                                                            <td align=center><?php echo $no; ?></td>
                                                                            <td>
                                                                                <input type="text" name="no_po" value="<?php echo $arrPO['no_po']; ?>" class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="date" name="tanggal_proses" value="<?php echo $arrPO['tanggal_proses']; ?>" class="form-control">
                                                                            </td>
                                                                            <td>                                                                                
                                                                                <input type="text" name="flag" value="<?php echo $arrPO['flag']; ?>" class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="vendor" value="<?php echo $arrPO['vendor']; ?>" class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="pengorder" value="<?php echo $arrPO['pengorder']; ?>" class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="estimasi" value="<?php echo $arrPO['estimasi']; ?>" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cp" value="<?php echo $arrPO['cp']; ?>" class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="number" name="tempo" value="<?php echo $arrPO['tanggal_tempo']; ?>" class="form-control">
                                                                            </td>
                                                                            <td class="col-lg-3"><?php echo $arrPO['item']; ?></td>
                                                                            <td align=center><?php echo $arrPO['qty']; ?><input type="hidden" id="qty" value="<?php echo $arrPO['qty']; ?>"></td>
                                                                            <td align=center><?php echo $arrPO['satuan']; ?></td>
                                                                            <td><input type="text" onkeyup="formatangka(this);
                                                                                                    autoComplete(this);" value="<?php echo $arrPO['harga']; ?>" id="harga" class="radio1 form-control" name="harga" style="text-align: right" placeholder="0"></td>
                                                                            <td><select name="ppn" id="ppn" class="form-control">
                                                                                    <option value="0">-Choose-</option>
                                                                                    <option value="Yes">Yes</option>
                                                                                    <option value="No">No</option>
                                                                                </select></td> 
                                                                            <td><input type="text" class="form-control" id="total" name="total" value="<?php echo $arrPO['total']; ?>" placeholder="0" style="text-align: right" <?php echo $readonly; ?>></td>
                                                                            
                                                                            <input type="hidden" value="<?php echo $arrPO['subtotal']; ?>" id="subtotal" class="form-control" name="subtotal" placeholder="0" style="text-align: right" <?php echo $readonly; ?>>
                                                                            
                                                                        </tr>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <tr><td colspan=4 align='center'>Tidak ada data yang dimasukkan.</td></tr>      
                                                                        <?php
                                                                    }
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-12">    
                                                    <div class="form-group">
                                                        <button class="btn btn-primary" name="save" type="submit"> Update</button>
                                                        <a href="./index.php?pic=checkdata&page=view" class="btn btn-default" > Back</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>
            <script type="text/javascript">

                function formatangka(objek) {
                    a = objek.value;
                    b = a.replace(/[^\d]/g, "");
                    c = "";
                    panjang = b.length;
                    j = 0;
                    for (i = panjang; i > 0; i--) {
                        j = j + 1;
                        if (((j % 3) === 1) && (j !== 1)) {
                            c = b.substr(i - 1, 1) + "," + c;
                        } else {
                            c = b.substr(i - 1, 1) + c;
                        }
                    }
                    objek.value = c;
                }

                function autoComplete(value)
                {
                    var harga = Number(document.getElementById('harga').value.replace(/[^0-9\.]+/g, ""));
                    var qty = document.getElementById('qty').value;
                    $('#ppn').prop("disabled", false);
                    $('#ppn').change(function () {
                        var ppn = $('#ppn').val();
                        if (ppn === 'Yes') {
                            jmlh = harga * (1.1);
                            $("#ppn option[value='0']").remove();
                        } else if (ppn === 'No') {
                            jmlh = harga;
                        }

                        if (jmlh > 0) {
                            sub = jmlh * qty;
                        } else {
                            sub = jmlh;
                        }
                        var a = parseInt(jmlh);
                        var b = parseInt(sub);
                        // var c = parseInt(subto);
                        // var d = parseInt(harganoppn);
                        var aaa = number_format(a);
                        var bbb = number_format(b);
                        // var ccc = number_format(c);
                        // var ddd = number_format(d);
                        if (a !== 0) {
                            document.getElementById("total").value = aaa;
                            document.getElementById("subtotal").value = bbb;
                        }
                    });
                }

                $(document).ready(function () {
                    $("#qty").val();
                    //                    $('#total').val("0");
                    //                    $('#subtotal').val("0");
                });


            </script>

            <?php
            if (isset($_POST['save'])) {
                $datenow = date("Y-m-d h:i:s");
                $no_po = $_POST['no_po'];
                $tanggal_proses = $_POST['tanggal_proses'];
                $flag = $_POST['flag'];
                $vendor = $_POST['vendor'];
                $pengorder = $_POST['pengorder'];
                $estimasi = $_POST['estimasi'];
                $cp = $_POST['cp'];
                $tempo = $_POST['tempo'];
                $harga = $_POST['harga'];
                $ppn = $_POST['ppn'];
                $total = $_POST['total'];
                $subtotal = $_POST['subtotal'];
                $id = $gets['id'];
                $updateby = $get['uName'];
                $updated = $datenow;

                $sql = "UPDATE `purchasing` SET "
                        . "`no_po`='$no_po', "
                        . "`tanggal_proses`='$tanggal_proses', "
                        . "`flag`='$flag', "
                        . "`vendor`='$vendor', "
                        . "`pengorder`='$pengorder', "
                        . "`estimasi`='$estimasi', "
                        . "`cp`='$cp', "
                        . "`tanggal_tempo`='$tempo', "
                        . "`harga`='$harga', "
                        . "`ppn`='$ppn', "
                        . "`total`='$total', "
                        . "`subtotal`='$subtotal', "
                        . "`updatedby`='$updateby', "
                        . "`updated`='$updated' "
                        . "WHERE `id`='$id'";

                $result = mysql_query($sql);

                if ($result) {
                    echo "<script>alert('Berhasil dirubah.')</script>";
                    echo "<script type='text/javascript'>document.location='./index.php?pic=checkdata&page=checkout&id=$id'; </script>";
                } else {
                    echo "<script>alert('Gagal! tidak dapat dirubah.')</script>";
                }
            }
        } elseif ($_GET['page'] === "checkout") {
            ?>

            <div class="header">
                <h1 class="page-title">Update Data</h1>
                <ul class="breadcrumb">
                    <li>Home </li>
                    <li class="active">Update Data</li>
                </ul>
            </div>
            <div class="main-content">
                <ul class="nav nav-tabs">
                    <li><a href="#procces1" data-toggle="tab">Process 1</a></li>
                    <li><a href="#procces2" data-toggle="tab">Process 2</a></li>
                    <li class="active"><a href="#procces3" data-toggle="tab">Process 3</a></li>
                </ul>

                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <?php
                        $gets = $_GET;
                        $id = $gets['id'];
                        $sql = mysql_query("Select * From purchasing where id = '$id'");
                        $rows = mysql_fetch_array($sql);
                        if ($rows['status_pic'] == 'Waiting For Quotation') {
                            $checked = 'selected';
                        } elseif ($rows['status_pic'] == 'Waiting Approval Director') {
                            $checkeds = 'selected';
                        } elseif ($rows['status_pic'] == 'PO Has Been Release') {
                            $checkedss = 'selected';
                        }
                        ?>
                        <br/>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade" id="procces1">
                                <div class="panel panel-default">
                                    <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data SMS Center - Phase 1</a>
                                    <div id="widget1container" class="panel-body collapse in">
                                        <div class="box-body table-responsive">
                                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post" id="tab">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>SMS Number / No. SMS</label>
                                                        <input type="text" name="no_sms" value="<?php echo $rows['no_sms']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>       
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Date Order / Tanggal Order</label>
                                                        <input type="date" name="tanggal_order" value="<?php echo $rows['tanggal_order']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Time / Jam SMS</label>
                                                        <input type="text" name="jam_sms" value="<?php echo $rows['jam_sms']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>                                              
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Buyer / Pemesan</label>
                                                        <input type="text" name="pemesan" value="<?php echo $rows['pemesan']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>                                    
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Nama Proyek</label>
                                                        <input type="text" name="nama_proyek" value="<?php echo $rows['nama_proyek']; ?>" class="form-control" <?php echo $readonly; ?>>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 well panel panel-primary">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Request Delivery / Permintaan Pengiriman</label>
                                                            <div class="form-inline">
                                                                <?php echo $rows['request']; ?>
                                                                <!--<input type="radio" name="radioreq" id="radiorequest" <?php echo $readonly; ?>> <input type="date" name="request" id="request" class="form-control" <?php echo $readonly; ?>>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--                                                    <div class="col-lg-4">
                                                                                                            <div class="form-group">
                                                                                                                <label></label>
                                                                                                                <div class="form-inline"><input type="radio" id="request" name="radioreq" value="BL" <?php echo $readonly; ?>> Beli Dilapangan</div>
                                                                                                            </div>
                                                                                                        </div>-->
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Notes / Catatan</label>
                                                            <textarea name="notes" rows="2" class="form-control" disabled=""><?php echo $rows['notes']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">                                        
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status_pic" class="form-control" disabled="">
                                                            <option value="Waiting For Quotation" <?php echo $checked; ?>>Waiting For Quotation</option>
                                                            <option value="Waiting Approval Director" <?php echo $checkeds; ?>>Waiting Approval Director</option>
                                                            <option value="PO Has Been Release" <?php echo $checkedss; ?>>PO Has Been Release</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="procces2">
                                <div class="panel panel-default">
                                    <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data Purchase Order - Phase 2</a>
                                    <div id="widget1container" class="panel-body collapse in">
                                        <div class="box-body table-responsive">
                                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="forms" method="post" id="tab2">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default" style="border-color: #337ab7;">
                                                        <a href="#widget1container" class="panel-heading" data-toggle="collapse" style="background: #337ab7; border-color: #337ab7; color: white;"> Order</a>
                                                        <style>
                                                            #data_filter, #data_length, #data_info, #data_paginate {
                                                                visibility: hidden;
                                                            }
                                                        </style>
                                                        <table id="data" class=" table table-bordered table-striped table-responsive">
                                                            <thead>
                                                                <tr>
                                                                    <th class="col-xs-0">No.</th>
                                                                    <th class="col-xs-2">PO Number / No. PO</th>
                                                                    <th class="col-xs-2">Date PO / Tanggal PO</th>
                                                                    <th class="col-xs-2">Flag / Bendera</th>
                                                                    <th class="col-xs-2">Vendor/ Supplier</th>
                                                                    <th class="col-xs-2">Buyer / Pemesan</th>
                                                                    <th class="col-xs-2">Estimation Date / Estimasi Kirim</th>
                                                                    <th class="col-xs-1">Contact Person / Kontak </th>
                                                                    <th class="col-xs-2">Term Of Date / Jatuh Tempo</th>
                                                                    <th class="col-lg-3">Item</th>
                                                                    <th class="col-xs-2">Qty</th>
                                                                    <th class="col-xs-2">Unit</th>
                                                                    <th class="col-xs-2">Unit Price / Harga Satuan</th>
                                                                    <th class="col-xs-2">PPN 10%</th>
                                                                    <th class="col-xs-1">Unit Price Final / Total</th>
                                                                    <th class="col-xs-1">Total Price Final / Total Harga * Qty</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="addProduct">
                                                                <?php
//                                                            $dates = new DateTime('+1 day');
                                                                $no = 1;
                                                                $dataPO = mysql_query("select * from purchasing where id='$id'");
                                                                while ($arrPO = mysql_fetch_array($dataPO)) {
                                                                    if ($arrPO['ppn'] == 'Yes') {
                                                                        $select = 'selected';
                                                                    } elseif ($arrPO['ppn'] == 'No') {
                                                                        $selected = 'selected';
                                                                    }
                                                                    if (!empty($arrPO)) {
                                                                        ?>
                                                                        <tr>
                                                                            <td align=center><?php echo $no; ?></td>
                                                                            <td>
                                                                                <?php echo $arrPO['no_po']; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $arrPO['tanggal_proses']; ?>
                                                                            </td>
                                                                            <td>                                                                                
                                                                                <?php echo $arrPO['flag']; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $arrPO['vendor']; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $arrPO['pengorder']; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $arrPO['estimasi']; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $arrPO['cp']; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $arrPO['tanggal_tempo']; ?>
                                                                            </td>
                                                                            <td class="col-lg-3"><?php echo $arrPO['item']; ?></td>
                                                                            <td align=center><?php echo $arrPO['qty']; ?></td>
                                                                            <td align=center><?php echo $arrPO['satuan']; ?></td>
                                                                            <td><?php echo $arrPO['harga']; ?></td>
                                                                            <td><?php echo $arrPO['ppn']; ?></td> 
                                                                            <td><?php echo $arrPO['total']; ?></td>
                                                                            <td><?php echo $arrPO['subtotal']; ?></td>
                                                                        </tr>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <tr><td colspan=4 align='center'>Tidak ada data yang dimasukkan.</td></tr>      
                                                                        <?php
                                                                    }
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>  
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane active in" id="procces3">
                                <div class="panel panel-default">
                                    <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data Purchase Order - Phase 3</a>
                                    <div id="widget1container" class="panel-body collapse in">
                                        <div class="box-body table-responsive">
                                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post" id="tab2">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default" style="border-color: #337ab7;">
                                                        <a href="#widget1container" class="panel-heading" data-toggle="collapse" style="background: #337ab7; border-color: #337ab7; color: white;"> Order</a>
                                                        <style>
                                                            #data_filter, #data_length, #data_info, #data_paginate {
                                                                visibility: hidden;
                                                            }
                                                        </style>
                                                        <table id="data" class=" table table-bordered table-striped table-responsive">
                                                            <thead>
                                                                <tr>
        <!--                                                                    <th>No.</th>
                                                                    <th>PO Number / No. PO</th>
                                                                    <th>Date PO / Tanggal PO</th>
                                                                    <th>Flag / Bendera</th>
                                                                    <th>Vendor/ Supplier</th>
                                                                    <th>Buyer / Pemesan</th>
                                                                    <th>Estimation Date / Estimasi Kirim</th>
                                                                    <th>Contact Person / Kontak </th>
                                                                    <th>Term Of Date / Jatuh Tempo</th>
                                                                    <th>Item</th>
                                                                    <th>Qty</th>
                                                                    <th>Unit</th>
                                                                    <th>Unit Price / Harga Satuan</th>
                                                                    <th>PPN 10%</th>
                                                                    <th>Unit Price Final / Total</th>
                                                                    <th>Total Price Final / Total Harga * Qty</th>-->
                                                                    <th>Delivery Date / Tanggal Kirim</th>
                                                                    <th>Delivery Order / Surat Jalan</th>
                                                                    <th>Recipient / Penerima</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $no = 1;
                                                                $dataCek = mysql_query("select * from purchasing where id='$id'");
                                                                while ($arr = mysql_fetch_array($dataCek)) {
                                                                    if (!empty($arr)) {
                                                                        ?>
                                                                        <tr>
                <!--                                                                            <td align=center><?php echo $no; ?></td>
                                                                            <td>
                                                                            <?php echo $arr['no_po']; ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php echo $arr['tanggal_proses']; ?>
                                                                            </td>
                                                                            <td>                                                                                
                                                                            <?php echo $arr['flag']; ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php echo $arr['vendor']; ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php echo $arr['pengorder']; ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php echo $arr['estimasi']; ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php echo $arr['cp']; ?>
                                                                            </td>
                                                                            <td>
                                                                            <?php echo $arr['tanggal_tempo']; ?>
                                                                            </td>
                                                                            <td class="col-lg-3"><?php echo $arr['item']; ?></td>
                                                                            <td align=center><?php echo $arr['qty']; ?></td>
                                                                            <td align=center><?php echo $arr['satuan']; ?></td>
                                                                            <td><?php echo $arr['harga']; ?></td>
                                                                            <td><?php echo $arr['ppn']; ?></td> 
                                                                            <td><?php echo $arr['total']; ?></td>
                                                                            <td><?php echo $arr['subtotal']; ?></td>                                                                -->
                                                                            <td>
                                                                                <input type="date" name="delivery" value="<?php echo $arr['tanggal_kirim']; ?>" class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="surat_jalan" value="<?php echo $arr['surat_jalan']; ?>" class="form-control">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="recipient" value="<?php echo $arr['recipient']; ?>" class="form-control">
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <tr><td colspan=4 align='center'>Tidak ada data yang dimasukkan.</td></tr>      
                                                                        <?php
                                                                    }
                                                                    $no++;
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>  
                                                </div>
                                                <div class="col-lg-12">    
                                                    <div class="form-group">
                                                        <button class="btn btn-primary" name="save" type="submit"> Update</button>
                                                        <a href="./index.php?pic=checkdata&page=view" class="btn btn-default" > Back</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['save'])) {
                $delivery = $_POST['delivery'];
                $surat_jalan = $_POST['surat_jalan'];
                $recipient = $_POST['recipient'];
                $id = $gets['id'];
                $datenows = date("Y-m-d h:i:s");
                $update2by = $get['uName'];
                $updated2 = $datenows;

                $sql = "UPDATE `purchasing` SET "
                        . "`tanggal_kirim`='$delivery', "
                        . "`surat_jalan`='$surat_jalan', "
                        . "`recipient`='$recipient', "
                        . "`updated2by`='$update2by', "
                        . "`updated2`='$updated2' "
                        . "WHERE (`id`='$id')";
                $result = mysql_query($sql);

                if ($result) {
                    echo "<script>alert('Berhasil dirubah.')</script>";
                    echo "<script type='text/javascript'>document.location='./index.php?pic=checkdata&page=view'; </script>";
                } else {
                    echo "<script>alert('Gagal! tidak dapat dirubah.')</script>";
                }
            }
        } elseif ($_GET['page'] === "print") {
            $gets = $_GET;
            $id = $gets['id'];
            $sql = mysql_query("SELECT DATE_FORMAT(tanggal_order,'%d %b %Y') pesan, jam_sms, no_sms, pemesan, nama_proyek, tanggal_proses,  
                            (select replace(GROUP_CONCAT(DISTINCT p.item,' (', p.qty, p.satuan,')'),',',', ') orderan from purchasing p where p.no_sms='$id') orderan,
                            createdby,notes, request FROM purchasing WHERE no_sms='$id'
                            GROUP BY no_sms");
            $rows = mysql_fetch_array($sql);
            if ($get['uName'] == 'admin') {
                $active = "";
            } else if ($get['uName'] == 'lani') {
                $active = "readonly";
            }
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
            <style>
                .well-a{
                    border: 2px solid black;
                }
                .hr{
                    border: 1px solid #101010;
                }
                .table > thead > tr > th{
                    border: 1px solid black;
                }

            </style>
            <div class="main-content" id="print">
                <div class="row">
                    <div class="col-md-11 col-offset-1">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h5><span class="fa fa-building"></span> Procurement Information Center</h5>
                                <h6 class="text-center">Permintaan Pembelian Bahan</h6><p class="text-center text-sm text-primary">via SMS center 0816.1511.6666</p>
                                <div class="hr"></div>
                            </div>
                            <div class="pull-left unstyled col-sm-6 col-md-6">
                                <p class="text-sm"><strong>Pemesan : </strong><?php echo $rows['pemesan']; ?></p>
                                <p class="text-sm"><strong>Tanggal : </strong><?php echo $rows['pesan']; ?></p>     
                            </div>
                            <div style="text-align: right;" class="pull-right unstyled col-sm-6 col-md-6">
                                <p class="text-sm"><strong>Jam SMS : </strong><?php echo $rows['jam_sms']; ?></p>
                                <p class="text-sm"><strong>No. SMS : </strong><?php echo $rows['no_sms']; ?></p>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <table style="border: 1px solid black;" class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-sm">Pesanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><p class="text-justify text-sm">Permintaan Material Proyek <strong><?php echo $rows['nama_proyek']; ?></strong>: <?php echo $rows['orderan']; ?><br>Request <?php echo $rows['request']; ?>, Catatan (<?php echo $rows['notes']; ?>)  </p></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="pull-left unstyled col-sm-6 col-md-6">
                                <p class="text-sm">Diterima,</p><br/>
                                <p class="text-sm">(<?php echo $get['uName']; ?>)<br/><p class="text-sm"><i>Operator</i></p></p>     
                            </div>
                            <div style="text-align: right;" class="pull-right unstyled col-sm-6 col-md-6">
                                <p class="text-sm">Diarsip,</p><br/>
                                <p class="text-sm">(_______)<br/><p class="text-sm"><i>Pembelian</i></p></p> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <!--<input type="button" value="Open window"  />-->
                    <button class="btn btn-danger" onclick="printDiv('print');"><span class="fa fa-print"> Print</span></button>
                    <a href="./index.php?pic=checkdata&page=view" class="btn btn-default"> Back</a>
                </div>
            </div>
            <?php
        }
    }    