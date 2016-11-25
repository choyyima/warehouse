<?php

$con = mysql_connect('localhost', 'root', 'Password1') or die(mysql_error());

if (!$con) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}

if (!mysql_select_db("aryana_warehouse_db")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}