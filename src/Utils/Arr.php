<?php

namespace Utils;

class Arr
{
  public static function get($array, $key, $default = null)
  {
    if (isset($array[$key])) {
      return $array[$key];
    }

    return $default;
  }

  public static function withoutEmpty($array)
  {
    return array_filter($array, function ($value) {
      return !empty($value);
    });
  }
}
