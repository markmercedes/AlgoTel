<?php

$bookinCart = new Booking\BookingCart();
$itemsInCart = $bookinCart->items();

?>

<section class="hero-section" id="small-cart" data-source="/BookingCart?_withLayout=0">
  <div class="container">
    <div class="row">
      <?php if (!count($itemsInCart)) : ?>
        <div class="col-lg-6">
          <h3 class="mb-3">Tu carrito de reservaciones esta vacio!</h3>
          <a href="/Rooms" class="btn btn-primary">Ver Habitaciónes disponibles</a>
        </div>
      <?php else : ?>
        <div class="col-lg-6">
          <div id="small-cart" data-source="/BookingCart/show">
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
                          Check - in: <strong><?= $item->checkinDate() ?></strong>
                          <br />
                          Check - out: <strong><?= $item->checkoutDate() ?></strong>
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
                <form method="post" id="checkout-form" action="/Checkout/create">
                  <div class="form-check mb-3">
                    <input required="required" class="form-check-input" type="checkbox" value="" id="accept-term-and-conditions">
                    <label class="form-check-label" for="accept-term-and-conditions">
                      Estoy de acuerdo con los terminos y condiciones
                    </label>
                  </div>
                  <div class="form-check mb-3">
                    <input required="required" class="form-check-input" type="checkbox" value="" id="accept-payment-option-on-checkout">
                    <label class="form-check-label" for="accept-payment-option-on-checkout">
                      Pagar a la llegada
                    </label>
                  </div>
                  <div class="form-check mb-3">
                    <label for="customer_notes" class="form-label">Datos adicionales</label>
                    <textarea class="form-control" id="customer_notes" name="customer_notes" rows="3"></textarea>
                  </div>
                  <hr />
                  <div class="d-grid gap-2">
                    <button form="checkout-form" class="btn btn-primary"><i class="fa fa-check"></i> Completar reserva</button>
                  </div>
                </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

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