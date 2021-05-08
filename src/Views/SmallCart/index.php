<?php

$itemsInCart = (new Booking\BookingCart())->items();

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
                Precio: <?= number_format($item->total()) ?>
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
      <a href="/BookingCart" class="btn btn-primary">Reservar</a>
    </div>
  </div>
</div>