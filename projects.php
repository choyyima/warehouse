<?php
include "config.php";
include "function.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <div class="header">
            <h1 class="page-title">Project</h1>
            <ul class="breadcrumb">
                <li>Master </li>
                <li class="active">Project</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="btn-toolbar list-toolbar">
                        <a href="index.php?pic=project&page=create" class="btn btn-success"><span class="fa fa-plus"></span> Add / Tambah</a> 
                    </div>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Project / Proyek</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <table id="data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>      
                                            <th>Project Name / Nama Project</th>
                                            <th width="80px">Address / Alamat</th>
                                            <th>Phone / Telepon </th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("select * from project");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            $status = ($result['status'] = 1) ? 'Active' : 'Done';
                                            echo"<tr>
                                                    <td>$no</td>
                                                    <td>$result[nama_project]</td>
                                                    <td>$result[alamat]</td>    
                                                    <td>$result[telepon]</td>
                                                    <td>$status</td>
                                                    <td><a href='index.php?pic=project&page=edit&id=$result[id]' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a>
                                                        <a href='index.php?pic=project&page=delete&DeLid=$result[id]' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Delete' onClick=\"return confirm('Are you sure to delete this the data?');\"><span class='glyphicon glyphicon-trash'></span></a></td>
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
        ?>
        <div class="header">
            <h1 class="page-title">Create Data Project</h1>
            <ul class="breadcrumb">
                <li>Master </li>
                <li class="active">Create Data Project</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <br/>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data Project</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <div class="tab-pane active in">
                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post" id="tab">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Project Name / Nama Proyek</label>
                                                <input type="text" name="nama_project" placeholder="Project Name / Nama Project" class="form-control" required="">
                                            </div>
                                        </div>       
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Address / Alamat</label>
                                                <textarea name="alamat" placeholder="Address" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Phone / Telepon</label>
                                                <input type="text" name="phone" placeholder="08xxxxxxxxx" class="form-control">
                                            </div>
                                        </div>         
                                        <div class="col-lg-4">                                        
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="1">Active / Aktif</option>
                                                    <option value="2">Done / Selesai</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">    
                                            <div class="form-group">
                                                <button type="submit" onClick="return confirm('Are you sure to submit the data? You will not allowed to edit the submitted data later');" class="btn btn-primary" name="saveadd">Submit</button>
                                                <a href="index.php?pic=project&page=view" class="btn btn-default" > Back</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (isset($_POST['saveadd'])) {
                $nama_project = $_POST['nama_project'];
                $alamat = $_POST['alamat'];
                $phone = $_POST['phone'];
                $status = $_POST['status'];
                $sql = "insert into `project` SET "
                        . "`nama_project`='$nama_project', "
                        . "`alamat`='$alamat', "
                        . "`telepon`='$phone', "
                        . "`status`='$status' ";

                $resultq = mysql_query($sql);
                if ($resultq) {
                    echo "<script>alert('Berhasil ditambah.')</script>";
                    echo "<script type='text/javascript'>document.location='./index.php?pic=project&page=view'; </script>";
                } else {
                    echo "<script>alert('Gagal! tidak dapat ditambah.')</script>";
                }
            }
        } elseif ($_GET['page'] === "update") {
            ?>

            <div class="header">
                <h1 class="page-title">Edit Data Project</h1>
                <ul class="breadcrumb">
                    <li>Master </li>
                    <li class="active">Edit Data Project</li>
                </ul>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <?php
                        $gets = $_GET;
                        $id = "";
                        $checked = "";
                        $checkeds = "";
                        $id = $gets['id'];
                        $sql = mysql_query("Select * From project where id = '$id'");
                        $rows = mysql_fetch_array($sql);
                        if ($rows['status'] == '1') {
                            $checked = 'selected';
                        } elseif ($rows['status'] == '2') {
                            $checkeds = 'selected';
                        }
                        ?>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade">
                                <div class="panel panel-default">
                                    <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Edit Project</a>
                                    <div id="widget1container" class="panel-body collapse in">
                                        <div class="box-body table-responsive">
                                            <div class="tab-pane active in">
                                                <form action="#" name="form" method="post" id="tab">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Project Name / Nama Proyek</label>
                                                            <input type="text" name="nama_project" placeholder="Project Name / Nama Project" class="form-control" value="<?php echo $rows['nama_project']; ?>" required="">
                                                        </div>
                                                    </div>       
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Address / Alamat</label>
                                                            <textarea name="alamat" placeholder="Address" class="form-control" required=""> <?php echo $rows['alamat']; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Phone / Telepon</label>
                                                            <input type="text" name="phone" placeholder="08xxxxxxxxx" class="form-control"  value="<?php echo $rows['telepon']; ?>" required="">
                                                        </div>
                                                    </div>         
                                                    <div class="col-lg-4">                                        
                                                        <div class="form-group">
                                                            <label>Status</label>
                                                            <select name="status" class="form-control">
                                                                <option value="1" <?php echo $checked ?>>Active / Aktif</option>
                                                                <option value="2" <?php echo $checked ?>>Done / Selesai</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">    
                                                        <div class="form-group">
                                                            <button type="submit" onClick="return confirm('Are you sure to submit the data? You will not allowed to edit the submitted data later');" class="btn btn-primary" name="saveadd">Submit</button>
                                                            <a href="index.php?pic=project&page=view" class="btn btn-default" > Back</a>
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
            </div>
            <?php
            if (isset($_POST['save'])) {
                $id = $gets['id'];
                $nama_project = $_POST['nama_project'];
                $alamat = $_POST['alamat'];
                $phone = $_POST['phone'];
                $status = $_POST['status'];
                $sql = "insert into `project` SET "
                        . "`nama_project`='$nama_project', "
                        . "`alamat`='$alamat', "
                        . "`telepon`='$phone', "
                        . "`status`='$status' "
                        . "WHERE `id`='$id'";

                $result = mysql_query($sql);

                if ($result) {
                    echo "<script>alert('Berhasil dirubah.')</script>";
                    echo "<script type='text/javascript'>document.location='./index.php?pic=project&page=view'; </script>";
                } else {
                    echo "<script>alert('Gagal! tidak dapat dirubah.')</script>";
                }
            }
        } elseif ($_GET['page'] === "delete") {
            $DeLid = $_GET['DeLid'];
            $delete = mysql_query("delete from project where id='$DeLid'");
            if ($delete) {
                echo "<script>alert('Berhasil dihapus.')</script>";
                echo "<script type='text/javascript'>document.location='./index.php?pic=project&page=view'; </script>";
            } else {
                echo "<script>alert('Tidak dapat dihapus.')</script>";
            }
        }
    }