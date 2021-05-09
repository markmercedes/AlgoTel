<section class="hero-section">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center mx-auto mb-5">
        <h2>Tus Bookings</h2>
      </div>
      <div class="col-lg-6 mx-auto">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No. Orden</th>
              <th>Fecha</th>
              <th>Total</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($this->orders as $item) : ?>
              <tr>
                <td>
                  <a class="text-primary" href="<?= linkTo(['Bookings', 'show'], ['id' => $item->id]) ?>">
                    <?= $item->formattedId() ?>
                  </a>

                  <br />
                  <div>
                    <?= statusLabel($item->status) ?>
                  </div>
                </td>
                <td>
                  <?= $item->orderDate() ?>
                </td>
                <td>
                  <strong><?= number_format($item->total, 2) ?></strong>
                </td>
                <td>
                  <?php if ($item->cancelableByCustomer()) : ?>
                    <a href='/CancelBooking/new?id=<?= $item->id ?>' class="btn btn-sm btn-outline-danger"> <i class='fa fa-times'></i> Cancelar</a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>