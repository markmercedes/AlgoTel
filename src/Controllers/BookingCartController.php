<?php

namespace Controllers;

class BookingCartController extends Base
{
  public function index()
  {
    $this->render(
      'index',
      layout: $this->withLayout()
    );
  }
}
