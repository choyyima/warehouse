<?php
include "../config.php";
$modal_id = $_GET['id'];
$modal = mysql_query("Delete FROM stockin WHERE id='$modal_id'");
header('location:../index.php?wr=stockin&page=view');
