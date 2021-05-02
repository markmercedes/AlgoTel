<?php

namespace Models;

use Models\Base;

class Room extends Base
{
  const FIELD_TYPES = [
    'price_config' => 'Json',
    'gallery' => 'FileGallery',
  ];

  static protected $tableName = 'rooms';
}
