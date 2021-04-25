<?php

namespace Web;

use Utils\Arr;

class Params
{
  static function pathPart($index)
  {
    $uri = strtok($_SERVER["REQUEST_URI"], '?');
    $uriParts = explode('/', $uri);

    return Arr::get($uriParts, $index);
  }

  static function get($key = null, $default = null)
  {
    if (!$key) {
      return $_GET;
    }

    if (isset($_REQUEST[$key])) {
      return $_REQUEST[$key];
    }

    return $default;
  }

  static function post($key = null, $default = null)
  {
    if (!$key) {
      return $_POST;
    }

    if (isset($_POST[$key])) {
      return $_POST[$key];
    }

    return $default;
  }


  static function pathSize()
  {
    $uri = $_SERVER['REQUEST_URI'];
    $uriParts = explode('/', $uri);
    return count($uriParts);
  }
}
