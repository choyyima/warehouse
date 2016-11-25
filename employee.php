<?php
include "config.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <div class="header">
            <h1 class="page-title">Employee</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Employee</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="btn-toolbar list-toolbar" style="margin-top: -30px;">
                        <a href="index.php?pic=pm&page=create" class="btn btn-success"><span class="fa fa-plus"></span> Tambah</a>                        
                        <div class="btn-group">
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Employee</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <table id="data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>
                                            <th>Action</th>
                                            <th width="80px">Nama</th>
                                            <th>Jabatan</th>
                                            <th>No. HP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("SELECT e.id, e.nama, e.no_hp, j.nama jabatan FROM employee e left outer join jabatan j on e.id_jabatan = j.id");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            echo"<tr>
                                                    <td>$no</td>";
                                            echo "<td><a href= 'index.php?pic=pm&page=update&id=$result[id]' class='btn btn-info'> Edit</a> ";
                                            echo "<a href= 'index.php?pic=pm&page=update&id=$result[id]' class='btn btn-danger'> Delete</a></td>";
                                            echo "    
                                                    <td>$result[nama]</td>    
                                                    <td>$result[jabatan]</td>
                                                    <td>$result[no_hp]</td>
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
            <h1 class="page-title">Create Data</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Create Data</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    ?>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="home">
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" value="" class="form-control" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select name="jabatan" class="form-control" required="">
                                            <option value="0">-Pilih-</option>
                                            <?php
                                            $sql_jabatan = mysql_query("SELECT * FROM jabatan");
                                            while ($data = mysql_fetch_array($sql_jabatan)) {
                                                ?>
                                                <option value="<?php echo $data['id']; ?>"><?php echo $data['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>No. HP</label>
                                        <input name="no_hp" type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" name="saveadd" type="submit"> Save</button>
                                        <a href="index.php?pic=pm&page=view" class="btn btn-default">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <?php
        if (isset($_POST['saveadd'])) {
            $nama = $_POST['nama'];
            $jabatan = $_POST['jabatan'];
            $no_hp = $_POST['no_hp'];

            $sql = "insert into `employee` SET "
                    . "`nama`='$nama', "
                    . "`id_jabatan`='$jabatan', "
                    . "`no_hp`='$no_hp'";

            $result = mysql_query($sql);
            $getIDemp = mysql_insert_id();

            $sql_user = "insert into user set "
                    . "username= '$nama', "
                    . "password= '$nama', "
                    . "oauth='yes', "
                    . "status='active', "
                    . "id_employee='$getIDemp'";
            $resultuser = mysql_query($sql_user);

            if ($result) {
                echo "<script>alert('Berhasil ditambah.')</script>";
                echo "<script type='text/javascript'>document.location='./index.php?pic=pm&page=view'; </script>";
            } else {
                echo "<script>alert('Gagal! tidak dapat ditambah.')</script>";
            }
        }
    } elseif ($_GET['page'] === "update") {
        ?>

        <div class="header">
            <h1 class="page-title">Update Employee</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Update Employee</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <?php
                    $gets = $_GET;
                    $id = $gets['id'];
                    $sql = mysql_query("Select * From employee where id = '$id'");
                    $rows = mysql_fetch_array($sql);
                    if ($get['uName'] == 'admin') {
                        $active = "";
                    } else if ($get['uName'] == 'lani') {
                        $active = "readonly";
                    }
                    ?>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="home">
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" value="<?php echo $rows['nama']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <select name="jabatan" class="form-control" required="">
                                            <option value="0">-Pilih-</option>
                                            <?php
                                            $sql_jabatan = mysql_query("SELECT * FROM jabatan where id = $id");
                                            while ($data = mysql_fetch_array($sql_jabatan)) {
                                                ?>
                                                <option value="<?php echo $data['id']; ?>" selected="selected"><?php echo $data['nama'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>No. HP</label>
                                        <input type="text" name="no_hp" value="<?php echo $rows['no_hp']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" name="update" type="submit"> Update</button>
                                        <a href="index.php?pic=pm&page=view" class="btn btn-default">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <?php
        if (isset($_POST['update'])) {
            $nama = $_POST['nama'];
            $jabatan = $_POST['jabatan'];
            $no_hp = $_POST['no_hp'];
            $id = $gets['id'];

            $sql = "UPDATE `employee` SET "
                    . "`nama`='$nama', "
                    . "`id_jabatan`='$jabatan', "
                    . "`no_hp`='$no_hp' "
                    . "WHERE (`id`='$id')";
            // echo $sql;
            // die();

            $result = mysql_query($sql);

            if ($result) {
                echo "<script>alert('Berhasil dirubah.')</script>";
                echo "<script type='text/javascript'>document.location='./index.php?pic=pm&page=view'; </script>";
            } else {
                echo "<script>alert('Gagal! tidak dapat dirubah.')</script>";
            }
        }
    }
}