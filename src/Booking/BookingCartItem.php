<?php

namespace Booking;

class BookingCartItem
{
  public $item;
  public $room;

  function __construct($item, $room)
  {
    $this->item = $item;
    $this->room = $room;
  }

  function roomName()
  {
    return $this->room->name;
  }

  function qty()
  {
    return $this->item->qty;
  }

  function id()
  {
    return $this->item->id;
  }

  function total()
  {
    return $this->item->total;
  }

  function checkinDate()
  {
    return \DateTime::createFromFormat('Y-m-d', $this->item->dateIn)->format('Y-m-d');
  }

  function checkoutDate()
  {
    return \DateTime::createFromFormat('Y-m-d', $this->item->dateOut)->format('Y-m-d');
  }
}
