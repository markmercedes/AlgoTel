<section class="hero-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="room-gallery">

          <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php foreach ($this->item->gallery as $index => $img) : ?>
                <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>">
                  <img class="d-block w-100" src='<?= uploadsUrl($img); ?>' />
                </div>
              <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <div class="py-3">
            <h2><?= $this->item->name ?></h2>
            <h4 class="mt-2 color-dark">Desde: <?= number_format($this->item->minPrice()) ?></h4>
          </div>

          <div class="py-3">
            <p><?= htmlspecialchars($this->item->description) ?></p>
          </div>

          <div class="room-amenities mt-5 row">
            <h3 class="mb-3">Amenidades y servicios</h3>
            <?php foreach ($this->item->amenities() as $amenity) : ?>
              <div class="col-lg-6 col-12 thin-list py-3 mr-3">
                <i class="fa fa-check color-theme-primary"></i>
                <?= $amenity ?>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="room-price mt-5">
            <h3 class="mb-3">Precio actual</h3>
            <table class="table table-bordered table-theme-primary">
              <tr>
                <?php foreach ($this->item->price_config as $day => $price) : ?>
                  <td>
                    <?= substr($day, 0, 3) ?>
                  </td>
                <?php endforeach; ?>
              </tr>
              <tr>
                <?php foreach ($this->item->price_config as $day => $price) : ?>
                  <td>
                    <?= number_format($price) ?>
                  </td>
                <?php endforeach; ?>
              </tr>
            </table>
          </div>

        </div>
      </div>

      <div class="col-lg-4">

        <div class="d-grid gap-2">

          <a class="btn btn-primary call-to-action-btn mb-4" href="#">
            <h2 class="text-light">Agendar ahora</h2>
          </a>
        </div>

        <?php $this->renderPartial('/Bookings/_form') ?>
      </div>
    </div>
  </div>
  <hr />

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h3 class="my-5">Otras habitaciones</h3>
        <div id="lightSlider">
          <?php foreach ($this->item->similarRooms() as $room) : ?>
            <li>

              <div class="card">
                <a href="<?= lintoToReservation(['Rooms'], ['id' => $room->id]) ?>">
                  <img class="card-img-top" src='<?= uploadsUrl($room->gallery[0]); ?>' />
                </a>
                <div class="card-body">
                  <a href="<?= lintoToReservation(['Rooms', 'show'], ['id' => $room->id]) ?>">
                    <h5><?= $room->name ?></h5>
                  </a>
                  <h5>Desde: <?= number_format($room->minPrice()) ?></h5>
                  <p><?= substr($room->description, 0, 100) ?>...</p>
                </div>

              </div>
            </li>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>