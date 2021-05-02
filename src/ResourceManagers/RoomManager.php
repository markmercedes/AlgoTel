<?php

namespace ResourceManagers;

class RoomManager extends Base
{
  const MODEL_CLASS = 'Models\\Room';
  const RESOURCE_LABEL = 'Habitacion';
  const RESOURCES_LABEL = 'Habitaciones';
  const EDITABLE_ATTRIBUTES = ['name', 'description', 'room_type_id', 'quantity', 'room_capacity_id', 'max_children', 'extra_description', 'price_config', 'gallery',];
  const LISTABLE_ATTRIBUTES = ['name', 'quantity', 'room_capacity_id', 'room_type_id', 'max_children'];
  const ATTRIBUTE_TYPES = [
    'gallery' => ['type' => 'ImageGallery', 'label' => 'Image Gallery'],
    'name' => ['type' => 'String', 'label' => 'Nombre'],
    'description' => ['type' => 'Text', 'label' => 'Descripcion'],
    'max_children' => ['type' => 'Integer', 'label' => 'Ninos por habitacion'],
    'quantity' => ['type' => 'Integer', 'label' => 'Cantidad disponible'],
    'extra_description' => ['type' => 'Text', 'label' => 'Informacion adicional', 'rows' => 15],
    'room_capacity_id' => ['type' => 'BelongsTo', 'label' => 'Capacidad', 'modelClass' => '\\Models\\RoomCapacity'],
    'room_type_id' => ['type' => 'BelongsTo', 'label' => 'Tipo', 'modelClass' => '\\Models\\RoomType'],
    'price_config' => ['type' => 'PriceConfig', 'label' => 'Precio regular'],
  ];
}
