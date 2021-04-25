<?php

namespace Config;

class App
{
  public static function viewsPath()
  {
    $folderPath = implode(DIRECTORY_SEPARATOR, func_get_args());

    if (!empty($folderPath)) {
      $folderPath .= '.php';
    }

    $rootPath = (realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views'));

    return implode(DIRECTORY_SEPARATOR, [
      $rootPath,
      $folderPath
    ]);
  }
}
