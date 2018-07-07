<?php
# Config file for constant variables

/* App Root
 * we want to get relative path to the app root folder
 * /var/www/html/mvc/app
 */
define('APP_ROOT', dirname(dirname(__FILE__)));

/*
 *URL Root
 */
//define('URL_ROOT', 'http://'.$_SERVER['HTTP_HOST'].'/mvc');
define('URL_ROOT', '_URL_');

/*
 * Site Name
 */
define('SITE_NAME', '_YOURSITENAME_');

#----------------Database Parameters----------------#
define('DB_HOST','localhost');
define('DB_USER', '_USERPARAM_');
define('DB_PASSWORD', '_PASSWORD_PARAM_');
define('DB_NAME', '_DBPARAM_');
?>
