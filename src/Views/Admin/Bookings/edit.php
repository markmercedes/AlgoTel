<?= $this->renderPartial('_form') ?>


<div class="card col-lg-10 col-md-12 mt-5">
  <div class="card-header">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>Habitación</th>
          <th>Check - in</th>
          <th>Check - out</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($this->model()->orderItems() as $item) : ?>
          <tr>
            <td><?= $item->room->name ?></td>
            <td><?= $item->checkin_date ?></td>
            <td><?= $item->checkout_date ?></td>
            <td><?= number_format($item->total, 2) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="3">Total</th>
          <th><?= number_format($this->model()->total, 2) ?></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>