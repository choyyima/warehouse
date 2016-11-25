<?php

session_start();
if (!empty($_SESSION['uName'])) {
    $_SESSION['uName'] = '';
    session_destroy();
}
header("Location:index.html");
