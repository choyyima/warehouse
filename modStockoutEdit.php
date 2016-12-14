<?php
include "./config.php";
$modal_id = $_GET['modal_id'];
$modalQueryStockin = mysql_query("SELECT * FROM stockout WHERE id='$modal_id'");
while ($dataStockin = mysql_fetch_array($modalQueryStockin)) {
    ?>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Edit Stock In</h4>
            </div>

            <div class="modal-body">
                <form action="action/editStockout.php" name="modal_popup" enctype="multipart/form-data" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Tanggal Keluar:</label>
                        <div class="col-sm-3">
                            <input type="date" name="tanggal_keluar" class="form-control" value="<?php echo $dataStockin["tanggal_keluar"]; ?>">
                        </div>
                        <label class="col-sm-3 control-label">No. Surat Jalan: </label>
                        <div class="col-sm-4">
                            <input type="text" name="no_sj" class="form-control"  value="<?php echo $dataStockin["no_surat_jalan"]; ?>">
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
                                            <input type="text" name="proyek" class="form-control" id="asal_proyek" readonly="" value="<?php echo $dataStockin["asal_proyek"]; ?>">
                                        </div>                                                        
                                        <label class="col-sm-2 control-label">Lokasi Simpan: </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="tujuan" class="form-control" id="lokasi_simpan" readonly="" value="<?php echo $dataStockin["lokasi"]; ?>"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label class="col-sm-2 control-label">Status/Kondisi: </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="status" class="form-control" id="kondisi" readonly="" value="<?php echo $dataStockin["kondisi"]; ?>">
                                        </div>
                                        <label class="col-sm-2 control-label">Keterangan: </label>
                                        <div class="col-sm-4">
                                            <textarea name="memo" class="form-control" id="keterangan" readonly=""> <?php echo $dataStockin["keterangan"]; ?></textarea>
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
                                            <td><select name="nama_barang" class="item" id="js-example-basic-single">
                                                    <option value="0">-----------Pilih-----------</option>
                                                    <?php
                                                    $qBarang = "select id,nama_barang,jumlah from stockin";
                                                    $rBarang = mysql_query($qBarang);
                                                    while ($dBarang = mysql_fetch_array($rBarang)) {
                                                        ?>
                                                        <option value="<?php echo $dBarang['id']; ?>"><?php echo $dBarang['nama_barang'] . " - ( tersedia " . $dBarang["jumlah"] . ")"; ?></option>
                                                    <?php } ?>
                                                </select></td>
                                            <td><input type="text" name="jumlah" class="form-control" id="jml" readonly="" style="text-align: right;" onkeyup="autoComplete(this);" value="<?php echo $dataStockin["jumlah"]; ?>"></td>
                                            <td><input type="text" name="satuan" class="form-control" id="sat" readonly="" value="<?php echo $dataStockin["satuan"]; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">Barang yang di ambil</td>
                                            <td style="width: 50px;"><input type="text" name="jumlah_ambil" class="form-control" style=" text-align: right;" id="jml_ambil" onkeyup="autoComplete(this);" value="<?php echo $dataStockin["jumlah_diambil"]; ?>"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: right;">Total</td>
                                            <td><input type="text" name="total" class="form-control" style=" text-align: right;" id="tot" readonly="" value="<?php echo $dataStockin["total"]; ?>"></td>
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
                                    <input type="text" name="destination" class="form-control" value="<?php echo $dataStockin["tujuan"]; ?>">
                                </div>
                                <label class="col-sm-2 control-label">Memo UVB: </label>
                                <div class="col-sm-4">
                                    <textarea name="ovb" class="form-control"> <?php echo $dataStockin["no_memo_ovb"]; ?></textarea>
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
            </div>
        </div>
    </div>
    <?php
}