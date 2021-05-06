<?php

namespace ResourceManagers;

class RegistrationManager extends Base
{
  const MODEL_CLASS = 'Models\\User';
  const RESOURCE_LABEL = 'Usuario';
  const RESOURCES_LABEL = 'Usuarios';
  const EDITABLE_ATTRIBUTES = ['first_name', 'last_name', 'email', 'phone', 'password'];
  const LISTABLE_ATTRIBUTES = ['first_name', 'last_name'];
  const ATTRIBUTE_TYPES = [
    'first_name' => ['type' => 'String', 'label' => 'Nombre'],
    'last_name' => ['type' => 'String', 'label' => 'Apellido'],
    'phone' => ['type' => 'String', 'label' => 'Tel.'],
    'email' => ['type' => 'Email', 'label' => 'email'],
    'password' => ['type' => 'Password', 'label' => 'password'],
  ];
}
