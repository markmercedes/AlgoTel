<?php

namespace Booking;

use Utils\Arr;

class BookingCart
{
  private function rawItems()
  {
    try {
      $cookie = Arr::get($_COOKIE, 'CART', '[]');

      return json_decode($cookie);
    } catch (\Throwable $th) {
      return [];
    }
  }

  function hasItems()
  {
    return count($this->items()) > 0;
  }

  function isEmpty()
  {
    return !$this->hasItems();
  }

  function clear()
  {
    setcookie("CART", "[]", time() - 3600, '/');
  }

  function items()
  {
    return $this->items ??= array_map(function ($item) {
      return new BookingCartItem($item, $this->rooms()[$item->room_id]);
    }, $this->rawItems());
  }

  function total()
  {
    return array_reduce($this->items(), function ($result, $item) {
      return $result + $item->total();
    }, 0);
  }

  function checkinDate()
  {
    return min(array_map(function ($item) {
      return $item->checkinDate();
    }, $this->items()));
  }

  function checkoutDate()
  {
    return max(array_map(function ($item) {
      return $item->checkoutDate();
    }, $this->items()));
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
