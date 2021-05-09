<?php

namespace Controllers;

use Models\BookingOrder;
use Web\Params;

class CancelBookingController extends Base
{
  protected $order;

  const VALID_ACTION_METHODS = ['new', 'destroy'];

  function new()
  {
    $id = Params::get('id');
    $this->order = $this->order = $this->findOrder($id);

    parent::new();
  }

  function destroy()
  {
    $id = Params::post('id');
    $cancellation_notes = Params::post('cancellation_notes');

    $this->order = $this->findOrder($id);
    $this->order->cancellation_notes = $cancellation_notes;
    $this->order->cancelled_at = date("Y-m-d H:i:s");
    $this->order->status = 'cancelled';

    $this->order->save();

    header('Location: /Bookings/show?id=' . $this->order->id);

    exit();
  }

  protected function findOrder($id)
  {
    return BookingOrder::where(
      conditions: [
        'user_id = ' . $this->currentUserID(),
        "status in ('pending', 'processing')",
        'id = ' . $id,
      ]
    )[0];
  }
}
