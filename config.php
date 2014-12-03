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

// Local database connection settings
define("SBMBIZ_DBTYPE","mysql"); // or mysqli
define("SBMBIZ_DBHOST","localhost");
define("SBMBIZ_DBUSER","sbmkorea");
define("SBMBIZ_DBPASS","sbmkoreacom123");
define("SBMBIZ_DBNAME","test");

define('LOCAL_SMTP_HOST', 'localhost');
define('LOCAL_SMTP_USER', 'kpbaek');
define('LOCAL_SMTP_PASS', '1111');
define('LOCAL_SMTP_PORT', '25');

define('SBM_LOCAL_EMAIL', 'kpbaek@localhost');
define('SBM_DOMAIN', 'http://127.0.0.1:9090');


// sbmkorea.url database connection settings
/**
define("SBMBIZ_DBTYPE","mysql"); // or mysqli
define("SBMBIZ_DBHOST","mysql.hostinger.kr");
define("SBMBIZ_DBUSER","u900714269_sbm");
define("SBMBIZ_DBPASS","sbmdealer!");
define("SBMBIZ_DBNAME","u900714269_sbm");

define('SBM_SMTP_HOST', 'mail.sbmkorea.url.ph');
define('SBM_SMTP_USER', 'sbmkorea@sbmkorea.url.ph');
define('SBM_SMTP_PASS', 'sbmkoreacom');
define('SBM_SMTP_PORT', '2525');

define('SBM_PUB_EMAIL', 'sbm@sbmkorea.url.ph');
define('SBM_DOMAIN', 'http://www.sbmkorea.url.ph');
*/

// sbmbiz database connection settings
/**
define("SBMBIZ_DBTYPE","mysql"); // or mysqli
define("SBMBIZ_DBHOST","db.sbmkorea.biz");
define("SBMBIZ_DBUSER","sbmbiz");
define("SBMBIZ_DBPASS","dealer123!");
define("SBMBIZ_DBNAME","dbsbmbiz");

define('SBM_SMTP_HOST', 'mail.sbmkorea.biz');
define('SBM_SMTP_USER', 'sbm@sbmkorea.biz');
define('SBM_SMTP_PASS', 'sbmmail123');
define('SBM_SMTP_PORT', '587');

define('SBM_DOMAIN', 'http://www.sbmkorea.biz');
*/

define('SBM_PUB_EMAIL', 'sbm@sbmkorea.biz');
define('SBM_SALES_EMAIL', 'sales@sbmkorea.biz');

