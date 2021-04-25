<?php

namespace Utils;

class Math
{
  static function isEven($value)
  {
    return $value % 2 == 0;
  }

  static function isOdd($value)
  {
    return !self::isEven($value);
  }
}
