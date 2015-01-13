<?php
// PHPGRID database connection settings
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

// url.ph database connection settings
define("SBMBIZ_DBTYPE","mysql"); // or mysqli
define("SBMBIZ_DBHOST","mysql.hostinger.kr");
define("SBMBIZ_DBUSER","u900714269_sbm");
define("SBMBIZ_DBPASS","sbmdealer!");
define("SBMBIZ_DBNAME","u900714269_sbm");


define('LOCAL_SMTP_HOST', 'localhost');
define('LOCAL_SMTP_USER', 'kpbaek');
define('LOCAL_SMTP_PASS', '1111');
define('LOCAL_SMTP_PORT', '25');
define('SBM_LOCAL_EMAIL', 'kpbaek@localhost');


define('SBM_SMTP_HOST', 'mx1.hostinger.kr');
define('SBM_SMTP_USER', 'sbmkorea@sbmkorea.url.ph');
define('SBM_SMTP_PASS', 'sbmkoreacom');
define('SBM_SMTP_PORT', '2525');

define('SBM_PUB_EMAIL', 'sbm@sbmkorea.url.ph');
define('SBM_SALES_EMAIL', 'sales@sbmkorea.url.ph');
define('SBM_DOMAIN', 'http://www.sbmkorea.url.ph');

