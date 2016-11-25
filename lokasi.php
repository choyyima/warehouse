<?php
include "config.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <div class="header">
            <h1 class="page-title">Location / Lokasi</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Location / Lokasi</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="btn-toolbar list-toolbar" style="margin-top: -30px;">
                        <a href="index.php?wr=location&page=create" class="btn btn-success"><span class="fa fa-plus"></span> Add / Tambah</a> 
                    </div>
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Location / Lokasi</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <table id="data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>      
                                            <th>Location / Lokasi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("select * from lokasi");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
//                                            $status = ($result['status'] = 1) ? 'Active' : 'Done';
                                            echo"<tr>
                                                    <td>$no</td>
                                                    <td>$result[nama]</td>
                                                    <td><a href='index.php?wr=location&page=update&id=$result[id]' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Edit'><span class='glyphicon glyphicon-pencil'></span></a>
                                                        <a href='index.php?wr=location&page=delete&DeLid=$result[id]' class='btn btn-sm' data-toggle='tooltip' data-placement='bottom' title='Delete' onClick=\"return confirm('Are you sure to delete this the data?');\"><span class='glyphicon glyphicon-trash'></span></a></td>
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
            <h1 class="page-title">Create Data Location / Lokasi</h1>
            <ul class="breadcrumb">
                <li>Master </li>
                <li class="active">Create Data Location / Lokasi</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">                    
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="home">
                            <div class="panel panel-default">
                                <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data Location / Lokasi</a>
                                <div id="widget1container" class="panel-body collapse in">
                                    <div class="box-body table-responsive">
                                        <div class="tab-pane active in">
                                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post" id="tab">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Location / Lokasi </label>
                                                        <input type="text" name="nama" placeholder="Location Name / Nama Lokasi" class="form-control" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" onClick="return confirm('Are you sure to submit the data?');" class="btn btn-primary" name="saveadd">Submit</button>
                                                        <a href="index.php?wr=location&page=view" class="btn btn-default" > Back</a>
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
        if (isset($_POST['saveadd'])) {
            $nama_lokasi = $_POST['nama'];
            $sql = "insert into `lokasi` SET "
                    . "`nama`='$nama_lokasi'";

            $resultq = mysql_query($sql);
            if ($resultq) {
                echo "<script>alert('Berhasil ditambah.')</script>";
                echo "<script type='text/javascript'>document.location='./index.php?wr=location&page=view'; </script>";
            } else {
                echo "<script>alert('Gagal! tidak dapat ditambah.')</script>";
            }
        }
    } elseif ($_GET['page'] === "update") {
        $gets = $_GET;
        $id = "";
//        $checked = "";
//        $checkeds = "";
        $id = $gets['id'];
        $sql = mysql_query("Select * From lokasi where id = '$id'");
        $rows = mysql_fetch_array($sql);
//        if ($rows['status'] == '1') {
//            $checked = 'selected';
//        } elseif ($rows['status'] == '2') {
//            $checkeds = 'selected';
//        }
        ?>

        <div class="header">
            <h1 class="page-title">Update Location / Lokasi</h1>
            <ul class="breadcrumb">
                <li>Master </li>
                <li class="active">Update Location / Lokasi</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane active in" id="home">
                            <div class="panel panel-default">
                                <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Create Data Location / Lokasi</a>
                                <div id="widget1container" class="panel-body collapse in">
                                    <div class="box-body table-responsive">
                                        <div class="tab-pane active in">
                                            <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post" id="tab">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Location / Lokasi</label>
                                                        <input type="text" name="nama_lokasi" placeholder="Location Name / Nama Lokasi" class="form-control" value="<?php echo $rows['nama']; ?>">
                                                    </div>                                                    
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" name="saveadd">Submit</button>
                                                        <a href="index.php?wr=location&page=view" class="btn btn-default" > Back</a>
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
        if (isset($_POST['saveadd'])) {
            $id = $gets['id'];
            $nama_lokasi = $_POST['nama_lokasi'];
            $sql = "update `lokasi` SET "
                    . "`nama`='$nama_lokasi' "
                    . "WHERE `id`='$id'";

            $result = mysql_query($sql);

            if ($result) {
                echo "<script>alert('Berhasil dirubah.')</script>";
                echo "<script type='text/javascript'>document.location='./index.php?wr=location&page=view'; </script>";
            } else {
                echo "<script>alert('Gagal! tidak dapat dirubah.')</script>";
            }
        }
    } elseif ($_GET['page'] === "delete") {
        $DeLid = $_GET['DeLid'];
        $delete = mysql_query("delete from lokasi where id='$DeLid'");
        if ($delete) {
            echo "<script>alert('Berhasil dihapus.')</script>";
            echo "<script type='text/javascript'>document.location='./index.php?wr=location&page=view'; </script>";
        } else {
            echo "<script>alert('Tidak dapat dihapus.')</script>";
        }
    }
}