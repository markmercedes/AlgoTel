<?php

namespace Web;

use Utils\Arr;

class Params
{
  static function pathPart($index)
  {
    $uri = $_SERVER['REQUEST_URI'];
    $uriParts = explode('/', $uri);

    return Arr::get($uriParts, $index);
  }

  static function get($key = null, $default = null)
  {
    if (isset($_REQUEST[$key])) {
      return $_REQUEST[$key];
    }

    return $default;
  }
}
