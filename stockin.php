<?php
include "config.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <style>
            .modal .modal-body{
                padding: 1em;
            }
        </style>
        <div class="header">
            <h1 class="page-title">Stock In / Stock Masuk</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Stock In / Stock Masuk</li>
            </ul>
        </div>

        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="btn-toolbar list-toolbar" style="margin-top: -30px;">
                        <a class="btn btn-success" data-target="#ModalAdd" data-toggle="modal"><span class="fa fa-plus"></span> Add / Tambah</a> 
                    </div>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Stock In / Stock Masuk</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <!--<table id="data" class="table table-bordered table-striped">-->
                                <table id="data" class="example table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>      
                                            <th>Date In/Tanggal Masuk</th>
                                            <th>Project/Proyek</th>
                                            <th>Item/Unit</th>
                                            <th>Type</th>                                            
                                            <th>Sum</th>
                                            <th>Satuan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("SELECT s.id,DATE_FORMAT(s.tanggal_masuk,'%d %b %Y') tgl, s.proyek, s.type, 
                                                    s.jumlah, s.satuan, s.satuan,s.status, u.nama nama_unit, 
                                                    l.nama nama_lokasi 
                                                    FROM stockin s
                                                    LEFT JOIN unit u on s.id_unit = u.id
                                                    LEFT JOIN lokasi l on s.id_lokasi = l.id");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
//                                            $status = ($result['status'] = 1) ? 'Active' : 'Done';
                                            echo"<tr>
                                                    <td>$no</td>
                                                    <td>$result[tgl]</td>
                                                    <td>$result[proyek]</td>
                                                    <td>$result[nama_unit]</td>
                                                    <td>$result[type]</td>
                                                    <td>$result[jumlah]</td>
                                                    <td>$result[satuan]</td>
                                                    <td>$result[status]</td>
                                                    <td><a href='#' class='open_modal' id='$result[id]' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a>
                                                        <a href='#' onclick='confirm_modal(\"action/delStockin.php?&id=$result[id]\");' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Delete'><span class='glyphicon glyphicon-trash'></span></a></td>
                                                    </tr>";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- Modal Popup untuk Add--> 
                                <div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Create Stock In</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid bd-example-row">
                                                    <form action="action/addStockin.php" name="modal_popup" enctype="multipart/form-data" method="POST" class="form-horizontal">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Tanggal Masuk</label>
                                                            <div class="col-sm-3">
                                                                <input type="date" name="tanggal_masuk" class="form-control" value="<?php echo date("d-m-Y"); ?>">
                                                            </div>
                                                            <!--                                                            <label class="col-sm-3 control-label">No. Surat Jalan: </label>
                                                                                                                        <div class="col-sm-4">
                                                                                                                            <input type="text" name="no_sj" placeholder="Nomor Surat Jalan" class="form-control">
                                                                                                                        </div>-->
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Asal Proyek: </label>
                                                            <div class="col-sm-4">
                                                                <input type="text" name="proyek" placeholder="Nama Proyek" class="form-control">
                                                            </div>                                                        
                                                            <label class="col-sm-1 control-label">Lokasi Simpan: </label>
                                                            <div class="col-sm-4">
                                                                <input type="text" name="tujuan" placeholder="Tujuan" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Nama Barang: </label>
                                                            <div class="col-sm-4">
                                                                <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" >
                                                            </div>
                                                            <label class="col-sm-1 control-label">Jum: </label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="jumlah" class="form-control" >
                                                            </div>
                                                            <label class="col-sm-1 control-label">Sat: </label>
                                                            <div class="col-sm-2">
                                                                <input type="text" name="satuan" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Status/Kondisi: </label>
                                                            <div class="col-sm-4">
                                                                <input type="text" name="status" placeholder="Status" class="form-control">
                                                            </div>
                                                            <label class="col-sm-1 control-label">Memo UVB: </label>
                                                            <div class="col-sm-5">
                                                                <textarea name="memo" class="form-control"></textarea>
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
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Popup untuk Edit--> 
                                <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

                                                                                                                                                                                                                                                                                                                                        <!--<script src="assets/js/jquery-1.11.1.min.js"></script>-->
        <!-- Javascript untuk popup modal Edit--> 
        <script type="text/javascript">
            $(document).ready(function () {
                $(".open_modal").click(function (e) {
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "modStockinEdit.php",
                        type: "GET",
                        data: {modal_id: m},
                        success: function (ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal('show', {backdrop: 'true'});
                        }
                    });
                });
            });

            //Javascript untuk popup modal Delete
            function confirm_modal(delete_url)
            {
                $('#modal_delete').modal('show', {backdrop: 'static'});
                document.getElementById('delete_link').setAttribute('href', delete_url);
            }
        </script>
        <?php
    }
}