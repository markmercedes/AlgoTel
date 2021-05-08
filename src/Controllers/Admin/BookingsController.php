<?php

namespace Controllers\Admin;

class BookingsController extends AdminBaseController
{
  const RESOURCE_MANAGER = 'ResourceManagers\BookingOrderManager';

  const VALID_ACTION_METHODS = [
    'index', 'edit', 'update'
  ];
}
