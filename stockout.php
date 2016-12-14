<?php
include "config.php";
include './helper.php';

$get = $_SESSION;
if (empty($get['uName'])) {
    header('Location: index.html');
}
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <script src="js/jquery-1.11.1.min.js"></script>
        <!--<script src="js/jquery-1.10.2.js"></script>-->
        <script src="helper.js"></script>

        <div class="header">
            <h1 class="page-title">Stock Out / Stock Keluar</h1>
            <ul class="breadcrumb">
                <li>Transaction </li>
                <li class="active">Stock Out / Stock Keluar</li>
            </ul>
        </div>

        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="btn-toolbar list-toolbar" style="margin-top: -30px;">
                        <a class="btn btn-success" data-target="#ModalAdd" data-toggle="modal"><span class="fa fa-plus"></span> Add / Tambah</a> 
                    </div>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Stock Out / Stock Keluar</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <!--<table id="data" class="table table-bordered table-striped">-->
                                <table id="data" class="example table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>      
                                            <th>Date Out/Tanggal Keluar</th>
                                            <th>Tujuan</th>
                                            <th>Item/Unit</th>                          
                                            <th>Available/Tersedia</th>
                                            <th>Amount Taken/Jumlah Diambil</th>
                                            <th>No. Memo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("SELECT sot.*, s.jumlah, s.nama_barang from stockout sot
                                                    LEFT OUTER JOIN stockin s on sot.id_stock_in = s.id");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
//                                            $status = ($result['status'] = 1) ? 'Active' : 'Done';
                                            echo"<tr>
                                                    <td>$no</td>
                                                    <td>$result[tanggal_keluar]</td>
                                                    <td>$result[tujuan]</td>
                                                    <td>$result[nama_barang]</td>
                                                    <td>$result[jumlah]</td>
                                                    <td>$result[jumlah_diambil]</td>
                                                    <td>$result[no_memo_ovb]</td>
                                                    <td><a href='#' class='open_modal' id='$result[id]' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a>
                                                        <a href='#' onclick='confirm_modal(\"action/delStockin.php?&id=$result[id]\");' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Delete'><span class='glyphicon glyphicon-trash'></span></a></td>
                                                    </tr>";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- Modal Popup untuk Add--> 
                                <div id="ModalAdd" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Create Stock Out</h4>
                                            </div>
                                            <div class="modal-body">
                                                <!--<div class="container-fluid bd-example-row">-->
                                                <form action="action/addStockout.php" name="modal_popup" enctype="multipart/form-data" method="POST" class="form-horizontal">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Tanggal Keluar:</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" name="tanggal_keluar" class="form-control" value="<?php echo date("d-m-Y"); ?>">
                                                        </div>
                                                        <label class="col-sm-3 control-label">No. Surat Jalan: </label>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="no_sj" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="panel panel-default" style="border-color: #337ab7;">
                                                            <a href="#" class="panel-heading" data-toggle="collapse" style="background: #337ab7; border-color: #337ab7; color: white;"> Pilih Barang</a>
                                                            <div id="widget1container" class="panel-body collapse in">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label class="col-sm-2 control-label">Asal Proyek: </label>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" name="proyek" class="form-control" id="asal_proyek" readonly="">
                                                                        </div>                                                        
                                                                        <label class="col-sm-2 control-label">Lokasi Simpan: </label>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" name="tujuan" class="form-control" id="lokasi_simpan" readonly="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <label class="col-sm-2 control-label">Status/Kondisi: </label>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" name="status" class="form-control" id="kondisi" readonly="">
                                                                        </div>
                                                                        <label class="col-sm-2 control-label">Keterangan: </label>
                                                                        <div class="col-sm-4">
                                                                            <textarea name="memo" class="form-control" id="keterangan" readonly=""></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <table class="table table-bordered table-striped">
                                                                        <thead>
                                                                        <th style="width: 250px;">Nama Barang</th>
                                                                        <th style="width: 100px;">Jumlah</th>
                                                                        <th style="width: 10px;">Satuan</th>
                                                                        </thead>
                                                                        <tr>
                                                                            <td>
                                                                                <select name="nama_barang" class="item" id="js-example-basic-single">
                                                                                    <option value="0">-----------Pilih-----------</option>
                                                                                    <?php
                                                                                    $qBarang = "select id,nama_barang,jumlah from stockin";
                                                                                    $rBarang = mysql_query($qBarang);
                                                                                    while ($dBarang = mysql_fetch_array($rBarang)) {
                                                                                        ?>
                                                                                        <option value="<?php echo $dBarang['id']; ?>"><?php echo $dBarang['nama_barang'] . " - ( tersedia " . $dBarang["jumlah"] . ")"; ?></option>
                                                                                    <?php } ?>
                                                                                </select></td>
                                                                            <td><input type="text" name="jumlah" class="form-control" id="jml" readonly="" style="text-align: right;" onkeyup="autoComplete(this);"></td>
                                                                            <td><input type="text" name="satuan" class="form-control" id="sat" readonly=""></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;">Barang yang di ambil</td>
                                                                            <td style="width: 50px;"><input type="text" name="jumlah_ambil" class="form-control" style=" text-align: right;" id="jml_ambil" onkeyup="autoComplete(this);"></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: right;">Total</td>
                                                                            <td><input type="text" name="total" class="form-control" style=" text-align: right;" id="tot" readonly=""></td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <label class="col-sm-2 control-label">Tujuan Untuk: </label>
                                                                <div class="col-sm-4">
                                                                    <input type="text" name="destination" class="form-control">
                                                                </div>
                                                                <label class="col-sm-2 control-label">Memo UVB: </label>
                                                                <div class="col-sm-4">
                                                                    <textarea name="ovb" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-success" type="submit">
                                                                Confirm
                                                            </button>

                                                            <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!--</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Popup untuk Edit--> 
                                <div id="ModalEdit" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                </div>

                                <!-- Modal Popup untuk delete--> 
                                <div class="modal fade" id="modal_delete">
                                    <div class="modal-dialog">
                                        <div class="modal-content" style="margin-top:100px;">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
                                            </div>

                                            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                                                <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
                                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                //modal dialog edit
                $(".open_modal").click(function (e) {
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "modStockoutEdit.php",
                        type: "GET",
                        data: {modal_id: m},
                        success: function (ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal('show', {backdrop: 'true'});
                        }
                    });
                });

                //select2
                $("#js-example-basic-single").select2();

                //function onchange select2
                $('.item').on('change', function () {
                    var val = $(this).val();
                    $.ajax({
                        url: "helper.php",
                        data: "getValStd=" + val,
                        dataType: 'json',
                        cache: false,
                        type: 'GET',
                        success: function (data) {
                            $("#kondisi").val(data.kondisi);
                            $("#sat").val(data.satuan);
                            $("#jml").val(data.jumlah);
                            $("#keterangan").val(data.keterangan);
                            $('#asal_proyek').val(data.asal_proyek);
                            $("#lokasi_simpan").val(data.lokasi_simpan);
                        }
                    });
                });
            });

            //modal dialog delete
            function confirm_modal(delete_url)
            {
                $('#modal_delete').modal('show', {backdrop: 'static'});
                document.getElementById('delete_link').setAttribute('href', delete_url);
            }

            //count automatically
            function autoComplete(value)
            {
                var jumlah = parseInt(document.getElementById('jml').value);
                var jml_ambil = parseInt(document.getElementById('jml_ambil').value);
                var nul = "";

                if (jumlah > 0) {
                    sub = jumlah - jml_ambil;
                } else if (jumlah) {
                    sub = jumlah;
                }

                if (jml_ambil > jumlah) {
                    alert("Nilai Barang yang diambil tidak lebih dari jumlah stok yang tersedia");
                    document.getElementById("jml_ambil").value = nul;
                    document.getElementById("tot").value = jumlah;
                } else {
                    document.getElementById("tot").value = sub;
                }
            }
        </script>
        <?php
    }
}