<?php

namespace Config;

class App
{
  public static function viewsPath()
  {
    return (realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Views'));
  }
}
