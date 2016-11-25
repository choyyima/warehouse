<?php
include "config.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <div class="header">
            <h1 class="page-title">Users</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Users</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="btn-toolbar list-toolbar" style="margin-top: -30px;">
                        <a href="index.php?pic=user&page=create" class="btn btn-success"><span class="fa fa-plus"></span> Tambah</a>    
                    </div>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> User Data</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <table id="data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>
                                            <th width="80px">Username</th>
                                            <th>Oauth</th>
                                            <th>Status</th>
                                            <th>Last Login</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("SELECT * FROM user");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            echo"<tr>
                                                    <td>$no</td>    
                                                    <td>$result[username]</td>    
                                                    <td>$result[oauth]</td>
                                                    <td>$result[status]</td>
                                                    <td>$result[last_login]</td>                      
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
            <h1 class="page-title">Create User</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Create User</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="users">
                            <div class="panel panel-default">
                                <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data User</a>
                                <div id="widget1container" class="panel-body collapse in">
                                    <div class="box-body table-responsive">
                                        <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post" enctype="multipart/form-data">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label>Pegawai</label>
                                                    <select name="employee" class="form-control" required="">
                                                        <option value="0">-Pilih-</option>
                                                        <?php
                                                        $sql_jabatan = mysql_query("SELECT * FROM employee");
                                                        while ($data = mysql_fetch_array($sql_jabatan)) {
                                                            ?>
                                                            <option value="<?php echo $data['id']; ?>"><?php echo $data['nama'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Username</label>
                                                    <input type="text" name="username" value="" class="form-control" required="">
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input name="password" type="text" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12">
                                                <div class="panel panel-default" style="border-color: #337ab7;">
                                                    <a href="#widget1container" class="panel-heading" data-toggle="collapse" style="background: #337ab7; border-color: #337ab7; color: white;"> User Menu Permission</a>
                                                    <div id="widget1container" class="panel-body collapse in">

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <input type="checkbox" name="menu" id="selectall" onclick="toggleMenu(this);"/> <span class="label label-info">All</span>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="checkdata" id="checkbox" value="1"> Check Data
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="complain" id="checkbox" value="1"> Complain
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="employees" id="checkbox" value="1"> Employee
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="users" id="checkbox" value="1"> Users
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="project" id="checkbox" value="1"> Project
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="warehouse" id="checkbox" value="1"> Warehouse
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="workshop" id="checkbox" value="1"> Workshop
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="reset" id="checkbox" value="1"> Reset Password
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="panel panel-default" style="border-color: grey;">
                                                    <a href="#widget1container" class="panel-heading" data-toggle="collapse" style="background: #efefef; border-color: gray; color: black;"> Check Data Permission</a>
                                                    <div id="widget1container" class="panel-body collapse in">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <input type="checkbox" name="step" id="selectall" onclick="toggleCheckData(this);"/> <span class="label label-default">All</span>
                                                            </div>                                                            
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="add" id="step" value="1"> Add
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="proses1" id="step" value="1"> Edit 1
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="proses2" id="step" value="1"> Edit 2
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="delete" id="step" value="1"> Delete
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="download" id="step" value="1"> Download
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="print" id="step" value="1"> Print
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="price" id="step" value="1"> Price
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="checkbox" name="flag" id="step" value="1"> Flag
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-12">
                                                <div class="panel panel-default" style="border-color: #5cb85c;">
                                                    <a href="#widget1container" class="panel-heading" data-toggle="collapse" style="background: #5cb85c; border-color: #5cb85c; color: white;"> Location Permission</a>
                                                    <div id="widget1container" class="panel-body collapse in">
                                                        <div class="col-lg-12" style="height: 150px; overflow: auto;">
                                                            <div class="form-group">
                                                                <input type="checkbox" onclick="toggleLocation(this);" /> <span class="label label-success">All</span>                                                                
                                                            </div>
                                                            <?php
                                                            $qloc = "select nama_project FROM project
                                                                    WHERE `status` = '1'
                                                                    UNION
                                                                    SELECT nama_warehouse from warehouse
                                                                    WHERE `status` = '1'
                                                                    UNION 
                                                                    SELECT nama_workshop FROM workshop
                                                                    WHERE `status` = '1' order BY nama_project asc";
                                                            $qlocRest = mysql_query($qloc);
                                                            while ($row = mysql_fetch_array($qlocRest)) {
                                                                ?>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <input type="checkbox" name="lokasi[]" value="<?php echo $row['nama_project']; ?>" id="location"> <?php echo $row['nama_project']; ?>                                                                   
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="counter" id="counter">
                                            <!--                                            <div class="col-lg-12" style="height: 300px; width: 12em; overflow: auto;">
                                                                                        </div>-->
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <button class="btn btn-primary" name="saveadd" type="submit"> Save</button>
                                                    <a href="index.php?pic=user&page=view" class="btn btn-default">Back</a>
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
            function toggleMenu(source) {
                var checkboxes = document.querySelectorAll('input[id="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] !== source) {
                        checkboxes[i].checked = source.checked;
                    }
                }
            }

            function toggleCheckData(source) {
                var checkboxes = document.querySelectorAll('input[id="step"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] !== source) {
                        checkboxes[i].checked = source.checked;
                    }
                }
            }

            function toggleLocation(source) {
                var checkboxes = document.querySelectorAll('input[id="location"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] !== source) {
                        checkboxes[i].checked = source.checked;
                    }
                }
            }

        </script>
        <?php
        if (isset($_POST['saveadd'])) {
            $employee = $_POST['employee'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $checkdata = $_POST['checkdata'];
            $complain = $_POST['complain'];
            $employees = $_POST['employees'];
            $users = $_POST['users'];
            $project = $_POST['project'];
            $warehouse = $_POST['warehouse'];
            $workshop = $_POST['workshop'];
            $reset = $_POST['reset'];
            $add = $_POST['add'];
            $edit1 = $_POST['proses1'];
            $edit2 = $_POST['proses2'];
            $delete = $_POST['delete'];
            $download = $_POST['download'];
            $print = $_POST['print'];
            $price = $_POST['price'];
            $flag = $_POST['flag'];
            $lokasi = $_POST['lokasi'];

            $cnt = $_POST['counter'];
            $queryUser = "insert into `user` SET "
                    . "`username`='$username', "
                    . "`id_employee`='$employee', "
                    . "`password`='$password',"
                    . "`oauth`='yes', "
                    . "`status`='active'";

            $exc = mysql_query($queryUser);
            $getIdUser = mysql_insert_id();

            for ($i = 0; $i < count($lokasi); $i++) {
                $queryPermission = "insert into permission set "
                        . "`id_user`='$getIdUser', "
                        . "`checkdata`='$checkdata', "
                        . "`complain`='$complain', "
                        . "`employee`='$employees', "
                        . "`users`='$users', "
                        . "`project`='$project', "
                        . "`warehouse`='$warehouse', "
                        . "`workshop`='$workshop', "
                        . "`reset`='$reset', "
                        . "`add`='$add', "
                        . "`proses1`='$edit1', "
                        . "`proses2`='$edit2', "
                        . "`delete`='$delete', "
                        . "`download`='$download', "
                        . "`print`='$print', "
                        . "`price`='$price', "
                        . "`flag`='$flag', "
                        . "`lokasi`='$lokasi[$i]'";

                $excPermission = mysql_query($queryPermission);
            }

            if ($excPermission) {
                echo "<script>alert('Berhasil ditambah.')</script>";
                echo "<script type='text/javascript'>document.location='./index.php?pic=user&page=view'; </script>";
            } else {
                echo "<script>alert('Gagal! tidak dapat ditambah.')</script>";
            }
        }
    } else if ($_GET['page'] === 'update') {
        
    } else if ($_GET['page'] === 'delete') {
        
    }
}    