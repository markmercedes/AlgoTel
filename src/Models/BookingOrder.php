<?php

namespace Models;

use Booking\BookingCart;
use Models\Base;

class BookingOrder extends Base
{
  const STATUSES = [
    'pending' => 'Pendiente',
    'complete' => 'Completada',
    'processing' => 'En proceso',
    'cancelled' => 'Cancelada',
    'fulfilled' => 'Despachado'
  ];

  static protected $tableName = 'bookings';

  function formattedId()
  {
    return str_pad($this->id, 10, '0', STR_PAD_LEFT);
  }

  function isSancelled()
  {
    return $this->status == 'cancelled';
  }

  function orderDate()
  {
    return \DateTime::createFromFormat('Y-m-d', $this->order_date)->format('Y-m-d');
  }

  protected $user;

  function user()
  {
    return $this->user ??= User::find($this->user_id);
  }

  protected $orderItems;

  function orderItems()
  {
    return $this->orderItems ??= BookingOrderItem::where(["booking_id = {$this->id}"]);
  }

  function cancelableByCustomer()
  {
    return $this->status == 'pending' || $this->status == 'processing';
  }

  function buildFromBookingCart(BookingCart $bookingCart)
  {
    $this->total = $bookingCart->total();
    $this->status = 'pending';
    $this->order_date = date('Y-m-d');
    $this->checkin_date = $bookingCart->checkinDate();
    $this->checkout_date = $bookingCart->checkoutDate();

    if ($this->save()) {
      foreach ($bookingCart->items() as $item) {
        $orderItem = new BookingOrderItem();
        $orderItem->room_id = $item->room->id;
        $orderItem->booking_id = $this->id;
        $orderItem->checkin_date = $item->checkinDate();
        $orderItem->checkout_date = $item->checkoutDate();
        $orderItem->total = $item->total();
        $orderItem->save();
      }

      return true;
    } else {
      return false;
    }
  }
}
