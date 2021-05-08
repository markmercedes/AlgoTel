<?php

$itemsInCart = (new Booking\BookingCart())->items();

if (!count($itemsInCart)) {
?>
  <div id="small-cart">
    <section class="hero-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h3 class="mb-3 text-center">Tu carrito de reservaciones esta vacio!</h3>
            <?php $this->renderPartial('/Bookings/_form') ?>
          </div>
        </div>
      </div>
    </section>
  <?php
  return;
}

  ?>
  <section class="hero-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
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
                          Adultos: <?= $item->item->guests ?>
                          <br />
                          Ninos: <?= $item->item->children ?>
                          <br />
                          Precio: <strong><?= number_format($item->total()) ?></strong>
                          <br />
                          Check - in: <strong><?= $item->ckeckinDate() ?></strong>
                          <br />
                          Check - out: <strong><?= $item->ckeckoutDate() ?></strong>
                        </div>
                        <div class="col pt-2 text-end">
                          <a class="btn btn-outline-danger btn-sm text-end remove-item-from-cart" data-id='<?= $item->id() ?>'><i class="fa fa-trash"></i></a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach ?>
              </table>

              <?php if (!$this->currentUser()) : ?>
                <div class="alert alert-info mb-4" role="alert">
                  <strong>Debes acceder a tu cuenta o registrar una cuenta antes de continuar con la reservacion</strong>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="d-grid gap-2">
                      <a class="btn btn-primary" href='<?= linkTo(['Session'], ['ReturnUrl' => $_SERVER['REQUEST_URI']]) ?>'><i class="fa fa-user"></i> Login</a>
                    </div>
                  </div>
                  <div class="col">
                    <div class="d-grid gap-2">
                      <a class="btn btn-success" href='<?= linkTo(['Registrations', 'new'], ['ReturnUrl' => $_SERVER['REQUEST_URI']]) ?>'><i class="fa fa-key"></i> Registro</a>

                    </div>
                  </div>
                </div>
              <?php else : ?>
                <div class="d-grid gap-2">
                  <a href="/BookingCart" class="btn btn-primary">Completar reserva</a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <?php if ($this->currentUser()) : ?>
          <div class="col-lg-6">
            <div class="booking-form mb-3">
              <h3 class="mb-3 text-center">Detalles de cliente</h3>
              <table class="table">
                <tr>
                  <th>Nombre:</th>
                  <td><?= $this->currentUser()->first_name ?></td>
                </tr>
                <tr>
                  <th>Apellido:</th>
                  <td><?= $this->currentUser()->last_name ?></td>
                </tr>
                <tr>
                  <th>Tel:</th>
                  <td><?= $this->currentUser()->phone ?></td>
                </tr>
                <tr>
                  <th>Email:</th>
                  <td><?= $this->currentUser()->email ?></td>
                </tr>
              </table>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>