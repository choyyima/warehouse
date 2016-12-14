<?php
include "config.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <div class="header">
            <h1 class="page-title">Item/Unit</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Item/Unit</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="btn-toolbar list-toolbar" style="margin-top: -30px;">
                        <a class="btn btn-success" data-target="#ModalAdd" data-toggle="modal"><span class="fa fa-plus"></span> Add / Tambah</a> 
                    </div>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Item/Unit</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <table id="data" class="example table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>      
                                            <th>Item/Unit Name / Nama Item/Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("select * from unit");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
//                                            $status = ($result['status'] = 1) ? 'Active' : 'Done';
                                            echo"<tr>
                                                    <td>$no</td>
                                                    <td>$result[nama]</td>
                                                    <td><a href='#' class='open_modal' id='$result[id]' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a>
                                                        <a href='#' onclick='confirm_modal(\"action/delUnit.php?&id=$result[id]\");' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Delete'><span class='glyphicon glyphicon-trash'></span></a></td>
                                                    </tr>";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <!-- Modal Popup untuk Add--> 
                                <div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Create Unit</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="action/addUnit.php" name="modal_popup" enctype="multipart/form-data" method="POST">

                                                    <div class="form-group" style="padding-bottom: 20px;">
                                                        <label>Item/Unit Name / Nama Proyek</label>
                                                        <input type="text" name="nama_unit" placeholder="Item/Unit Name / Nama Item/Unit" class="form-control" required="">
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-success" type="submit">
                                                            Save
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".open_modal").click(function (e) {
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "modUnitEdit.php",
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