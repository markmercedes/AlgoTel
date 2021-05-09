<?php

namespace Models;

use Models\Base;
use Utils\Arr;

class User extends Base
{
  const ROLES = [
    'customer' => 'Cliente',
    'admin' => 'Admin'
  ];
  const STATUSSES = [
    'active' => 'Activo',
    'inactive' => 'Inactivo'
  ];

  static protected $tableName = 'users';


  protected function update($changes)
  {

    if (Arr::get($changes, 'password', 'EMPTY') == 'EMPTY') {
      unset($changes['password']);
    }

    parent::update($changes);
  }

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
