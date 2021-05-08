<?php

namespace Models;

use Models\Base;

class BookingOrderItem extends Base
{
  static protected $tableName = 'booking_items';

  const RELATED_MODELS = [
    'room' => 'room_id'
  ];
}
