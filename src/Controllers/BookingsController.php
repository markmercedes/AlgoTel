<?php

namespace Controllers;

use Models\BookingOrder;
use Web\Params;

class BookingsController extends Base
{
  protected $orders;
  protected $order;

  function index()
  {
    if (!$this->currentUser()) {
      header('Location: /');
      exit();
    }

    contentFor('title', 'Mis Bookings');

    $this->orders = BookingOrder::where(["user_id = {$this->currentUserID()}"]);

    parent::index();
  }

  function show()
  {
    if (!$this->currentUser()) {
      header('Location: /');
      exit();
    }

    $this->order = BookingOrder::find(Params::get('id'));

    contentFor('title', 'Booking #' . $this->order->formattedId());

    parent::show();
  }
}
