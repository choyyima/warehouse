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

        <div class="dialog">
            <div class="panel panel-default">
                <p class="panel-heading no-collapse">Reset your password</p>
                <div class="panel-body">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form" method="post">
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="text" name="newpassword" class="form-control span12 form-control">
                        </div>
                        <!--<a href="index.html" class="btn btn-primary pull-right">Reset Password</a>-->
                        <button class="btn btn-primary pull-right" name="save" type="submit"> Reset Password</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
        <?php
//$generate_no = date('dmy') . ;
        if (isset($_POST['save'])) {
            $newpassword = $_POST['newpassword'];
            $id = $get['oId'];

            $sql = "UPDATE `user` SET `password`='$newpassword' WHERE (`usrid`='$id')";

            $result = mysql_query($sql);

            if ($result) {
                echo "<script>alert('Password telah dirubah.')</script>";
                session_destroy();
                echo "<script type='text/javascript'>document.location='./index.html'; </script>";
            } else {
                echo "<script>alert('Password tidak dapat dirubah.')</script>";
            }
        }
    }
}  