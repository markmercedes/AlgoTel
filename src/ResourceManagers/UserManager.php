<?php

namespace ResourceManagers;

class UserManager extends Base
{
  const MODEL_CLASS = 'Models\\User';
  const RESOURCE_LABEL = 'Usuario';
  const RESOURCES_LABEL = 'Usuarios';
  const EDITABLE_ATTRIBUTES = ['first_name', 'last_name', 'email', 'phone', 'role', 'status', 'password'];
  const LISTABLE_ATTRIBUTES = ['first_name', 'last_name', 'email', 'role', 'status'];
  const ATTRIBUTE_TYPES = [
    'first_name' => ['type' => 'String', 'label' => 'Nombre'],
    'last_name' => ['type' => 'String', 'label' => 'Apellido'],
    'phone' => ['type' => 'String', 'label' => 'Tel.'],
    'email' => ['type' => 'Email', 'label' => 'email'],
    'password' => ['type' => 'Password', 'label' => 'password'],
    'role' => ['type' => 'Select', 'label' => 'Rol', 'items' => \Models\User::ROLES],
    'status' => ['type' => 'Select', 'label' => 'Estado', 'items' => \Models\User::STATUSSES],
  ];
}
