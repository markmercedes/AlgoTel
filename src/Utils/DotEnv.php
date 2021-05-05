<?php

namespace Utils;

class DotEnv
{
  static function load()
  {
    $_ENV['APP_ENV'] = getenv('APP_ENV');
    if (!$_ENV['APP_ENV']) $_ENV['APP_ENV'] = 'production';

    if ($_ENV['APP_ENV'] == 'live') {
      return;
    }

    if (!isset($_SERVER['DOCUMENT_ROOT']))
      $_SERVER['DOCUMENT_ROOT'] =
        str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME']);

    $env = "$_ENV[APP_ENV].env";
    $cur = __DIR__;
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    $found = false;
    while (!$found && strpos(realpath("$cur/$env"), $root) == 0) {
      $file = null;
      if (file_exists("$cur/.env")) $file = "$cur/.env";
      if (file_exists("$cur/$env")) $file = "$cur/$env";
      if (file_exists("$cur/environments/$env")) $file = "$cur/environments/$env";
      if ($file) {
        foreach (explode(PHP_EOL, file_get_contents($file)) as $line) {
          if (empty($line)) continue;
          list($var, $val) = explode("=", $line, 2);
          $_ENV[$var] = $val;
        }
        $found = true;
      }
      $cur = dirname($cur);
    }
  }
}
