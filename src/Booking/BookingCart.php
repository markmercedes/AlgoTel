<?php

namespace Booking;

use Utils\Arr;

class BookingCart
{
  private function rawItems()
  {
    try {
      return json_decode(Arr::get($_COOKIE, 'CART', '[]'));
    } catch (\Throwable $th) {
      return [];
    }
  }

  function items()
  {
    return $this->items ??= array_map(function ($item) {
      return new BookingItem($item, $this->rooms()[$item->room_id]);
    }, $this->rawItems());
  }

  function total()
  {
    return array_reduce($this->items(), function ($result, $item) {
      return $result + $item->total();
    }, 0);
  }

  protected $rooms;
  protected $items;

  function rooms()
  {
    return $this->rooms ??= array_reduce(\Models\Room::where(), function ($result, $item) {
      $result[$item->id] = $item;

      return $result;
    }, []);
  }
}
