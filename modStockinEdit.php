<?php
include "./config.php";
$modal_id = $_GET['modal_id'];
$modalQueryStockin = mysql_query("SELECT * FROM stockin WHERE id='$modal_id'");
while ($dataStockin = mysql_fetch_array($modalQueryStockin)) {
    ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Edit Stock In</h4>
            </div>

            <div class="modal-body">
                <form action="action/editStockin.php" name="modal_popup" enctype="multipart/form-data" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" value="<?php echo $dataStockin['id']; ?>">
                        <label class="col-sm-2 control-label">Tanggal Masuk</label>
                        <div class="col-sm-3">
                            <input type="date" name="tanggal_masuk" class="form-control" value="<?php echo $dataStockin['tanggal_masuk']; ?>">
                        </div>
                        <!--                                                            <label class="col-sm-3 control-label">No. Surat Jalan: </label>
                                                                                    <div class="col-sm-4">
                                                                                        <input type="text" name="no_sj" placeholder="Nomor Surat Jalan" class="form-control">
                                                                                    </div>-->
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Asal Dari: </label>
                        <div class="col-sm-4">
                            <input type="text" name="proyek" placeholder="Nama Proyek" class="form-control"  value="<?php echo $dataStockin['proyek']; ?>">
                        </div>                                                        
                        <label class="col-sm-1 control-label">Tujuan: </label>
                        <div class="col-sm-4">
                            <input type="text" name="tujuan" placeholder="Tujuan" class="form-control"  value="<?php echo $dataStockin['lokasi']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Barang: </label>
                        <div class="col-sm-4">
                            <input type="text" name="nama_barang" placeholder="Nama Barang" class="form-control" value="<?php echo $dataStockin['type']; ?>">
                        </div>
                        <label class="col-sm-1 control-label">Jum: </label>
                        <div class="col-sm-2">
                            <input type="text" name="jumlah" class="form-control" value="<?php echo $dataStockin['jumlah']; ?>">
                        </div>
                        <label class="col-sm-1 control-label">Sat: </label>
                        <div class="col-sm-2">
                            <input type="text" name="satuan" class="form-control" value="<?php echo $dataStockin['satuan']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status/Kondisi: </label>
                        <div class="col-sm-4">
                            <input type="text" name="status" placeholder="Status" class="form-control" value="<?php echo $dataStockin['status']; ?>">
                        </div>
                        <label class="col-sm-1 control-label">Memo UVB: </label>
                        <div class="col-sm-5">
                            <textarea name="memo" class="form-control"> <?php echo $dataStockin['keterangan']; ?></textarea>
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
    <?php
}