<?php

namespace Controllers;

class BookingCartController extends Base
{
  public function index()
  {

    contentFor('title', 'Completar Booking');

    $this->render(
      'index',
      layout: $this->withLayout()
    );
  }
}
