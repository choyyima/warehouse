<?php

function day_count($month = '', $year = '') {
    if (empty($month)) {
        $month = date('m');
    }
    if (empty($year)) {
        $year = date('Y');
    }
    return date('d', mktime(0, 0, 0, $month + 1, 0, $year));
}

function begin_date_month() {
    $d1 = "01";
    $m1 = Date('m');
    $y1 = Date('Y');
    $date1 = $y1 . "-" . $m1 . "-" . $d1;
    return $date1;
}

function last_date_month() {
    $d2 = day_count();
    $m2 = Date('m');
    $y2 = Date('Y');
    $date2 = $y2 . "-" . $m2 . "-" . $d2;
    return $date2;
}
