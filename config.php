<?php
// PHP Grid database connection settings
define("PHPGRID_DBTYPE","mysql"); // or mysqli
define("PHPGRID_DBHOST","localhost");
define("PHPGRID_DBUSER","sbmkorea");
define("PHPGRID_DBPASS","sbmkoreacom123");
define("PHPGRID_DBNAME","test");

// Automatically make db connection inside lib
define("PHPGRID_AUTOCONNECT",0);

// Basepath for lib
#define("PHPGRID_LIBPATH",dirname(__FILE__).DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR);
define("PHPGRID_LIBPATH",$_SERVER["DOCUMENT_ROOT"]."/lib/");
