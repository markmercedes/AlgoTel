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

  const RELATED_MODELS = [
    'roomCapacity' => 'room_capacity_id',
    'roomType' => 'room_type_id'
  ];

  function amenities()
  {
    return explode("\n", $this->extra_description);
  }

  function averagePrice($dateIn = null, $dateOut = null)
  {
    return round(array_sum(array_map(function ($price) {
      return (int)$price;
    }, array_values(get_object_vars($this->price_config)))) / 7.0, 2);
  }


  function totalPrice($dateIn = null, $dateOut = null)
  {
    return $dateOut->diff($dateIn)->days * $this->averagePrice($dateIn, $dateOut);
  }

  function minPrice($dateIn = null, $dateOut = null)
  {
    return round(min(array_map(function ($price) {
      return (int)$price;
    }, array_values(get_object_vars($this->price_config)))), 2);
  }

  function similarRooms()
  {
    $items = array_filter(static::where(limit: 6), function ($item) {
      return $item->id != $this->id;
    });

    shuffle($items);
    return $items;
  }
}
