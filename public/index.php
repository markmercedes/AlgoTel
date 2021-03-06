<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// if (php_sapi_name() !== 'cli-server') {
//   die('this is only for the php development server');
// }

if ($_SERVER['SCRIPT_NAME'] != '/index.php' && is_file($_SERVER['DOCUMENT_ROOT'] . '/' . $_SERVER['SCRIPT_NAME'])) {
  // probably a static file...
  return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';

require implode(DIRECTORY_SEPARATOR, ['..', 'src', 'Utils', 'functions.php']);
require implode(DIRECTORY_SEPARATOR, ['..', 'loader.php']);
spl_autoload_register('autoloadStrategy');

Utils\DotEnv::load();

ob_start();
session_start();

Controllers\Base::dispatchController();

$output = ob_get_contents();
ob_end_clean();

echo $output;
