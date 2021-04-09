<?php

namespace Utils;

class Arr
{
  public static function get($array, $key)
  {
    if (isset($array[$key])) {
      return $array[$key];
    }
  }
}
