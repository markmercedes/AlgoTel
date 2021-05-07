<?php

namespace Controllers;

use Models\Room;
use Web\Params;

class RoomsController extends Base
{
  public function index()
  {
    $this->items = array_filter(Room::where(), function ($item) {
      return $item->roomCapacity->capacity >= guests() && $item->max_children >= children();
    });

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
