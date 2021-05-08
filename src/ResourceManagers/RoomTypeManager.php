<?php

namespace ResourceManagers;

class RoomTypeManager extends Base
{
  const MODEL_CLASS = 'Models\\RoomType';
  const RESOURCE_LABEL = 'Tipo de Habitación';
  const RESOURCES_LABEL = 'Tipos de Habitaciónes';
  const EDITABLE_ATTRIBUTES = ['name', 'description'];
  const LISTABLE_ATTRIBUTES = ['name'];
  const LISTABLE_ACTIONS = ['edit', 'destroy'];
  const ATTRIBUTE_TYPES = [
    'name' => ['type' => 'String', 'label' => 'Nombre'],
    'description' => ['type' => 'Text', 'label' => 'Descripcion'],
  ];
}
