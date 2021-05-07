<?php

class BookingCart
{
  private function rawItems()
  {
    try {
      return json_decode($_COOKIE['CART']);
    } catch (\Throwable $th) {
      return [];
    }
  }
  function items()
  {
    return $this->items ??= array_map(function ($item) {
      return new BookingItem($item, $this->rooms()[$item->room_id]);
    }, $this->rawItems());
  }

  protected $rooms;
  protected $items;

  function rooms()
  {
    return $this->rooms ??= array_reduce(Models\Room::where(), function ($result, $item) {
      $result[$item->id] = $item;

      return $result;
    }, []);
  }
}

class BookingItem
{
  private $item;
  private $room;

  function __construct($item, $room)
  {
    $this->item = $item;
    $this->room = $room;
  }

  function roomName()
  {
    return $this->room->name;
  }

  function qty()
  {
    return $this->item->qty;
  }

  function id()
  {
    return $this->item->id;
  }

  function total()
  {
    return $this->item->total;
  }
}

$itemsInCart = (new BookingCart())->items();

if (!count($itemsInCart)) {
?>
  <div id="small-cart"></div>
<?php
  return;
}

?>
<div id="small-cart">
  <div class="booking-form mb-3">
    <h3 class="text-center mb-2">Tu booking</h3>
    <table class="table">
      <?php foreach ($itemsInCart as $item) : ?>
        <tr>
          <td>
            <div class="row">
              <div class="col-8">
                <strong><?= $item->roomName() ?></strong>
                <br />
                Precio: <?= $item->total() ?>
              </div>
              <div class="col pt-2 text-end">
                <a class="btn btn-outline-danger btn-sm text-end remove-item-from-cart" data-id='<?= $item->id() ?>'><i class="fa fa-trash"></i></a>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
    </table>
    <div class="d-grid gap-2">
      <a href="#" class="btn btn-primary">Reservar</a>
    </div>
  </div>
</div>