<?php

namespace ResourceManagers;

use Models\BookingOrder;
use Web\Params;

class BookingOrderManager extends Base
{
  const MODEL_CLASS = 'Models\\BookingOrder';
  const RESOURCE_LABEL = 'Booking';
  const RESOURCES_LABEL = 'Bookings';
  const EDITABLE_ATTRIBUTES = ['status', 'checkin_date', 'checkout_date', 'notes', 'cancellation_notes', 'cancelled_at'];
  const TOP_LIST_ACTIONS = [];
  const LISTABLE_ATTRIBUTES = ['id', 'user_id', 'status', 'order_date', 'checkin_date', 'checkout_date', 'total'];
  const ATTRIBUTE_TYPES = [
    'id' => ['type' => 'String', 'label' => 'No.'],
    'order_date' => ['type' => 'String', 'label' => 'Fecha'],
    'checkin_date' => ['type' => 'Date', 'label' => 'Check - in'],
    'checkout_date' => ['type' => 'Date', 'label' => 'Check - out'],
    'notes' => ['type' => 'Text', 'label' => 'Notas'],
    'cancellation_notes' => ['type' => 'Text', 'label' => 'Motivos de cancelación'],
    'cancelled_at' => ['type' => 'Date', 'label' => 'Fecha de cancelación'],

    'user_id' => ['type' => 'BelongsTo', 'label' => 'Cliente', 'modelClass' => '\\Models\\User'],
    'status' => ['type' => 'Select', 'label' => 'Estado', 'items' => BookingOrder::STATUSES],
  ];

  function items()
  {
    $conditions = [];

    $status = Params::get('order_status');
    if (!empty($status)) {
      $conditions[] = "status = '$status'";
    }

    $order_date = Params::get('order_date_submit');
    if (!empty($order_date)) {
      $conditions[] = "order_date = '$order_date'";
    }

    $checkin_date = Params::get('checkin_date_submit');
    if (!empty($checkin_date)) {
      $conditions[] = "checkin_date = '$checkin_date'";
    }

    $checkout_date = Params::get('checkout_date_submit');
    if (!empty($checkout_date)) {
      $conditions[] = "checkout_date = '$checkout_date'";
    }

    return BookingOrder::where(
      conditions: $conditions,
      order: 'order_date',
      direction: 'DESC',
      limit: 200
    );
  }
}
