<?php

$bookinCart = new Booking\BookingCart();
$itemsInCart = $bookinCart->items();

if (!count($itemsInCart)) {
?>
  <div id="small-cart" data-source="/SmallCart"></div>
<?php
  return;
}

?>
<div id="small-cart" data-source="/SmallCart">
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
                Precio: <?= number_format($item->total()) ?>
              </div>
              <div class="col pt-2 text-end">
                <a class="btn btn-outline-danger btn-sm text-end remove-item-from-cart" data-id='<?= $item->id() ?>'><i class="fa fa-trash"></i></a>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
      <tr>
        <td class="bg-light">
          <div class="row py-3">
            <div class="col-8">
              <strong>Total a pagar:</strong>
            </div>
            <div class="col-4 text-end text-success">
              <strong><?= number_format($bookinCart->total()) ?></strong>
            </div>
          </div>
        </td>
      </tr>
    </table>
    <div class="d-grid gap-2">
      <a href="/BookingCart" class="btn btn-primary">Reservar</a>
    </div>
  </div>
</div>