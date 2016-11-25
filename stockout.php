<?php
include "config.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
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
                                    <th>No.</th>
                                    <th>Tanggal Keluar</th>
                                    <th>No. Memo OVB</th>
                                    <th>No. Surat Jalan</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                    </thead>
                                    <?php
                                    //menampilkan data mysqli
                                    $no = 0;
                                    $qTestee = mysql_query("SELECT * FROM stockout");
                                    while ($dataTestee = mysql_fetch_array($qTestee)) {
                                        $no++;
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $dataTestee['tanggal_keluar']; ?></td>
                                            <td><?php echo $dataTestee['no_memo_ovb']; ?></td>
                                            <td><?php echo $dataTestee['no_surat_jalan']; ?></td>
                                            <td><?php echo $dataTestee['keterangan']; ?></td>
                                            <td>
                                                <a href="#" class='btn btn-xs btn-info open_modal' id='<?php echo $dataTestee['id']; ?>'><i class="ace-icon fa fa-pencil bigger-120"></i></a> 
                                                <a href="#" class='btn btn-xs btn-danger'onclick="confirm_modal('act/testeeDel.php?&modal_id=<?php echo $dataTestee['id']; ?>');"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>

                                <!-- Modal Popup untuk Add--> 
                                <div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Testee</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="act/testeeAdd.php" name="modal_popup" enctype="multipart/form-data" method="POST">

                                                    <div class="form-group" style="padding-bottom: 20px;">
                                                        <label for="Modal Name">Nama</label>
                                                        <input type="text" name="nama"  class="form-control" placeholder="Nama" required/>
                                                    </div>

                                                    <div class="form-group" style="padding-bottom: 20px;">
                                                        <label for="Modal Name">Tanggal Lahir</label>
                                                        <input type="date" name="tanggal_lahir"  class="form-control" placeholder="Tanggal Lahir" required/>
                                                    </div>

                                                    <div class="form-group" style="padding-bottom: 20px;">
                                                        <label for="Modal Name">Pendidikan</label>
                                                        <input type="text" name="pendidikan"  class="form-control" placeholder="Pendidikan" required/>
                                                    </div>

                                                    <div class="form-group" style="padding-bottom: 20px;">
                                                        <label for="Modal Name">Pekerjaan</label>
                                                        <input type="text" name="pekerjaan"  class="form-control" placeholder="Pekerjaan" required/>
                                                    </div>

                                                    <div class="form-group" style="padding-bottom: 20px;">
                                                        <label for="Modal Name">Telp.</label>
                                                        <input type="text" name="telp"  class="form-control" placeholder="Telepon" required/>
                                                    </div>

                                                    <div class="form-group" style="padding-bottom: 20px;">
                                                        <label for="Description">Alamat</label>
                                                        <textarea name="alamat" class="form-control" placeholder="Alamat" required/></textarea>
                                                    </div>

                                                    <!--                            <div class="form-group" style="padding-bottom: 20px;">
                                                                                    <label for="Date">Date</label>
                                                                                    <input type="text" name="date"  class="form-control" plcaceholder="Timestamp" disabled value="Timestamp" required/>
                                                                                </div>-->

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
                        url: "modTesteeEdit.php",
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