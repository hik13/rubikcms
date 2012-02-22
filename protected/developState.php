<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

define('CMS_CASCH_ENABLED',true);
define('YII_ENABLE_ERROR_HANDLER',false);
define('YII_ENABLE_EXCEPTION_HANDLER',false);
?>
