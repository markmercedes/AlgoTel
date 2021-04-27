<?php

namespace ResourceManagers;

class RoomCapacityManager extends Base
{
  const MODEL_CLASS = 'Models\\RoomCapacity';
  const RESOURCE_LABEL = 'Capacidad de Habitacion';
  const RESOURCES_LABEL = 'Capacidades de Habitaciones';
  const EDITABLE_ATTRIBUTES = ['name', 'capacity', 'position', 'description'];
  const LISTABLE_ATTRIBUTES = ['name', 'capacity'];
  const LISTABLE_ACTIONS = ['edit', 'destroy'];
  const ATTRIBUTE_TYPES = [
    'name' => ['type' => 'String', 'label' => 'Nombre'],
    'description' => ['type' => 'Text', 'label' => 'Descripcion'],
    'capacity' => ['type' => 'Integer', 'label' => 'Capacidad'],
    'position' => ['type' => 'Integer', 'label' => 'Posicion'],
  ];
}
