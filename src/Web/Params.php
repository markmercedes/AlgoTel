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

  static function files()
  {
    $files = [];
    $fieldsForFiles = array_keys($_FILES);

    foreach ($fieldsForFiles as $field) {
      $files[$field] = [];

      foreach ($_FILES[$field]['name'] as $index => $file) {
        if (!empty($file)) {
          $files[$field][] = [
            'name' => $file,
            'type' => $_FILES[$field]['type'][$index],
            'tmp_name' => $_FILES[$field]['tmp_name'][$index],
          ];
        }
      }
    }

    return $files;
  }


  static function post($key = null, $default = null)
  {
    $post = array_merge($_POST, static::files());

    if (!$key) {
      return $post;
    }

    if (isset($post[$key])) {
      return $post[$key];
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
