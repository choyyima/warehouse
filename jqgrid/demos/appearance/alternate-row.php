<?php
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 2.0.0
 * @license: see license.txt included in package
 */
// include db config
include_once("../../config.php");

// include and create object
include(PHPGRID_LIBPATH . "inc/jqgrid_dist.php");

// Database config file to be passed in phpgrid constructor
$db_conf = array(
    "type" => PHPGRID_DBTYPE,
    "server" => PHPGRID_DBHOST,
    "user" => PHPGRID_DBUSER,
    "password" => PHPGRID_DBPASS,
    "database" => PHPGRID_DBNAME
);

$g = new jqgrid($db_conf);

$opt = array();
$opt["rowNum"] = 10; // by default 20
$opt["sortname"] = 'id'; // by default sort grid by this field
$opt["sortorder"] = "desc"; // ASC or DESC
$opt["caption"] = "Check Data"; // caption of grid
$opt["autowidth"] = true; // expand grid to screen width
$opt["multiselect"] = FALSE; // allow you to multi-select through checkboxes
$opt["altRows"] = true;
$opt["altclass"] = "myAltRowClass";

$opt["rowactions"] = FALSE; // allow you to multi-select through checkboxes
// export XLS file
// export to excel parameters
$opt["export"] = array("format" => "pdf", "filename" => "my-file", "sheetname" => "test");

$g->set_options($opt);

$g->set_actions(array(
    "add" => FALSE, // allow/disallow add
    "edit" => FALSE, // allow/disallow edit
    "delete" => false, // allow/disallow delete
    "rowactions" => false, // show/hide row wise edit/del/save option
    "showhidecolumns" => true, // show/hide row wise edit/del/save option
    "export" => FALSE, // show/hide export to excel option
    "autofilter" => true, // show/hide autofilter for search
    "search" => "single" // show single/multi field search condition (e.g. simple or advance)
        )
);

// you can provide custom SQL query to display data
$g->select_command = "SELECT * FROM purchasing";

// this db table will be used for add,edit,delete
//$g->table = "purchasing";
// you can customize your own columns ...
//$col = array();
//$col["title"] = "Id"; // caption of column
//$col["name"] = "id"; // grid column name, must be exactly same as returned column-name from sql (tablefield or field-alias)
//$cols[] = $col;

$col = array();
$col["title"] = "Date Order";
$col["name"] = "tanggal_order";
$col["dbname"] = "LOWER(tanggal_order)";
$col["formatter"] = "date";
$col["formatoptions"] = array("srcformat" => 'Y-m-d', "newformat" => 'd M Y');
$col["editable"] = false; // this column is not editable
$col["align"] = "center";
$col["width"] = "175";
$cols[] = $col;

$col = array();
$col["title"] = "SMS No.";
$col["name"] = "no_sms";
$col["sortable"] = false; // this column is not sortable
$col["search"] = true; // this column is not searchable
$col["editable"] = false;
$col["align"] = "center";
$col["width"] = "115";
$cols[] = $col;

$col = array();
$col["title"] = "Buyer";
$col["name"] = "pemesan";
$col["editable"] = true; // this column is editable
$col["width"] = "200";
$cols[] = $col;

$col = array();
$col["title"] = "Project";
$col["name"] = "nama_proyek";
$col["editable"] = true;
$col["width"] = "375";
$cols[] = $col;

$col = array();
$col["title"] = "item";
$col["name"] = "item";
$col["editable"] = true;
$col["width"] = "500";
$cols[] = $col;

$col = array();
$col["title"] = "Qty";
$col["name"] = "qty";
$col["editable"] = true;
$col["width"] = "100";
$cols[] = $col;

$col = array();
$col["title"] = "Unit";
$col["name"] = "satuan";
$col["editable"] = true;
$col["width"] = "100";
$cols[] = $col;

$col = array();
$col["title"] = "Request Delivery";
$col["name"] = "request";
$col["editable"] = true;
$col["width"] = "220";
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "Date Process";
$col["name"] = "tanggal_proses";
$col["datefmt"] = "j F Y";
$col["formatter"] = "date";
$col["formatoptions"] = array("srcformat" => 'Y-m-d', "newformat" => 'd M Y');
$col["editable"] = FALSE;
$col["width"] = "220";
$col["align"] = "center";
$cols[] = $col;

$col = array();
$col["title"] = "PO No.";
$col["name"] = "no_po";
$col["editable"] = true;
$col["align"] = "center";
$col["width"] = "125";
$cols[] = $col;

$col = array();
$col["title"] = "Vendor";
$col["name"] = "vendor";
$col["editable"] = true;
$col["width"] = "325";
$cols[] = $col;

$col = array();
$col["title"] = "Shipping Estimate";
$col["name"] = "estimasi";
$col["editable"] = true;
$col["width"] = "255";
$cols[] = $col;

$col = array();
$col["title"] = "CP";
$col["name"] = "cp";
$col["editable"] = true;
$cols[] = $col;

// pass the cooked columns to grid
$g->set_columns($cols);

// generate grid output, with unique grid name as 'list1'
$out = $g->render("list1");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
    <head>
        <link rel="stylesheet" type="text/css" media="screen" href="../../lib/js/themes/redmond/jquery-ui.custom.css"></link>	
        <link rel="stylesheet" type="text/css" media="screen" href="../../lib/js/jqgrid/css/ui.jqgrid.css"></link>	

        <script src="../../lib/js/jquery.min.js" type="text/javascript"></script>
        <script src="../../lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
        <script src="../../lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
        <script src="../../lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
    </head>
    <body>
        <style>
            .myAltRowClass { background-color: #F1F1F1; background-image: none; }
        </style>
        <div style="margin:10px">
            <?php echo $out ?>
        </div>
    </body>
</html>
