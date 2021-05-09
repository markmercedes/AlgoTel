<?php

namespace Controllers;

use Models\Room;
use Web\Params;

class RoomsController extends Base
{
  public function index()
  {
    contentFor('title', 'Habitaciones disponibles');

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

    contentFor('title', $this->item->name);

    $this->render(
      'show',
      []
    );
  }
}
