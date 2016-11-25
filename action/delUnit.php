<?php

include "../config.php";
$id = $_GET['id'];
$modal = mysql_query("Delete FROM unit WHERE id='$id'");
header('location:../index.php?wr=unit&page=view');

