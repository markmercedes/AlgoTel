<?php

namespace ResourceManagers;

class RoomTypeManager extends Base
{
  const MODEL_CLASS = 'Models\\RoomType';
  const EDITABLE_ATTRIBUTES = ['name', 'slug', 'description'];
  const LISTABLE_ATTRIBUTES = ['name', 'slug'];
  const LISTABLE_ACTIONS = ['edit', 'destroy'];
  const ATTRIBUTE_TYPES = [
    'name' => ['type' => 'String', 'label' => 'Nombre'],
    'slug' => ['type' => 'String'],
    'description' => ['type' => 'Text', 'label' => 'Descripcion'],
  ];
}
