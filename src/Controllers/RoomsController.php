<?php

namespace Controllers;

use Models\Room;
use Web\Params;

class RoomsController extends Base
{
  public function index()
  {

    $this->items = Room::where();

    $this->render(
      'index',
      []
    );
  }

  public function show()
  {
    $this->item = Room::find(Params::get('id'));

    $this->render(
      'show',
      []
    );
  }
}
