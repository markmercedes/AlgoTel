<?php

namespace Models;

use Models\Base;

class User extends Base
{
  static protected $tableName = 'users';

  function isAdmin()
  {
    return $this->role == 'admin';
  }

  function __get($property)
  {
    if ($property == 'name') {
      return $this->fullName();
    }

    return parent::__get($property);
  }

  function fullName()
  {
    return implode(' ', [
      $this->first_name,
      $this->last_name
    ]);
  }
}
