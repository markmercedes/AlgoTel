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
    $this->orders = BookingOrder::where(["user_id = {$this->currentUserID()}"]);

    parent::index();
  }

  function show()
  {
    $this->order = BookingOrder::find(Params::get('id'));

    parent::show();
  }
}
