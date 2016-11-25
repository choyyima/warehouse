<?php

// PHP Grid database connection settings, Only need to update these in new project

define("PHPGRID_DBTYPE","mysql"); // mysql,oci8(for oracle),mssql,postgres,sybase
define("PHPGRID_DBHOST","localhost");
define("PHPGRID_DBUSER","root");
define("PHPGRID_DBPASS","Password1");
define("PHPGRID_DBNAME","orderkantor");

// Basepath for lib
define("PHPGRID_LIBPATH",dirname(__FILE__).DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR);