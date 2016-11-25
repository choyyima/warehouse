<?php
include "./config.php";
$modal_id = $_GET['modal_id'];
$modalQueryUnit = mysql_query("SELECT * FROM unit WHERE id='$modal_id'");
while ($dataUnit = mysql_fetch_array($modalQueryUnit)) {
    ?>
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Edit Data Testee</h4>
            </div>

            <div class="modal-body">
                <form action="action/editUnit.php" name="modal_popup" enctype="multipart/form-data" method="POST">                    
                    <input type="hidden" name="modal_id" class="form-control" value="<?php echo $dataUnit['id']; ?>" />
                    <div class="form-group" style="padding-bottom: 20px;">
                        <label>Item/Unit Name / Nama Proyek</label>
                        <input type="text" name="nama_unit" placeholder="Item/Unit Name / Nama Item/Unit" class="form-control" value="<?php echo $dataUnit['nama']; ?>">
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