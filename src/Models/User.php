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
}
