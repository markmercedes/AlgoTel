<section class="hero-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <?php foreach ($this->items as $item) : ?>
          <div class="item-in-list mb-5">
            <div class="row">
              <div class="col-5">
                <img src='<?= uploadsUrl($item->gallery[0]); ?>' />
              </div>
              <div class="col-7 item-in-list-content py-2">
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <a href='<?= lintoToReservation(['Rooms', 'show'], ['id' => $item->id]) ?>'>
                      <h3><?= $item->name ?></h3>
                    </a>
                  </li>
                  <li>Adultos: <?= $item->room_capacity_id ?>, Ninos: <?= $item->max_children ?></li>
                  <li>Desde: <?= number_format($item->minPrice()) ?> por noche</li>
                  <li class="mt-3"><a class="btn btn-sm btn-primary" href='#'>Seleccionar</a></li>
                </ul>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="col-lg-4">
        <?php $this->renderPartial('/Bookings/_form') ?>
      </div>
    </div>
  </div>
</section>

<style>
  .item-in-list {
    border: 1px solid #eee;
  }
</style>