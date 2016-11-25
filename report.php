<?php
include "config.php";
if (isset($_GET['page'])) {
    if ($_GET['page'] === 'view') {
        ?>
        <div class="header">
            <h1 class="page-title">Report</h1>
            <ul class="breadcrumb">
                <li>Home </li>
                <li class="active">Report</li>
            </ul>
        </div>
        <div class="main-content">
            <div class="row">       
                <div class="col-sm-12 col-md-12">
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse"> Employee</a>
                        <div id="widget1container" class="panel-body collapse in">
                            <div class="box-body table-responsive">
                                <table id="data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30px">No.</th>
                                            <th width="80px">Nama</th>
                                            <th>Jabatan</th>
                                            <th>No. HP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysql_query("SELECT e.id, e.nama, e.no_hp, j.nama jabatan FROM employee e left outer join jabatan j on e.id_jabatan = j.id limit 0,5");
                                        $total = mysql_num_rows($query);

                                        $no = 1;
                                        while ($result = mysql_fetch_array($query)) {
                                            echo"<tr>
                                                    <td>$no</td>";
                                            if ($get['uName'] == 'admin' || $get['uName'] == 'lani' || $get['uName'] == 'yesi') {
                                                echo "<td><a href= 'index.php?pic=pm&page=update&id=$result[id]' class='btn btn-info'> Edit</a> ";
                                                echo "<a href= 'index.php?pic=pm&page=update&id=$result[id]' class='btn btn-danger'> Delete</a></td>";
                                            }
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
    } 
}