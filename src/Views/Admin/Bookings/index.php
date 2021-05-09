<div class="card">
  <div class="card-header">
    <h1 class="h2"><?= yieldContent('title', $this->resourceManager()->resourcesLabel()) ?></h1>
  </div>
  <div class="card-body">
    <div class="action-toolbar pb-3">
      <?php foreach ($this->resourceManager()->topListActions() as $action) : ?>
        <?= $this->resourceManager()->renderModelAction(null, $action, 'index') ?>
      <?php endforeach; ?>
    </div>
    <div class="row">
      <div class="col-lg-3 col-12">
        <form action='/Admin/Bookings' id='reset-form' method="get">
        </form>
        <form action='/Admin/Bookings' method="get">
          <div class="mb-3">
            <label for='order_date' class="form-label">Fecha de orden</label>
            <input name='order_date' type="text" class="form-control date-input bg-white" data-value="<?= \Web\Params::get('order_date_submit') ?>" />
          </div>

          <div class="mb-3">
            <label for='checkin_date' class="form-label">Fecha de Check - in</label>
            <input name='checkin_date' type="text" class="form-control date-input bg-white" data-value="<?= \Web\Params::get('checkin_date_submit') ?>" />
          </div>

          <div class="mb-3">
            <label for='checkout_date' class="form-label">Fecha de Check - out</label>
            <input name='checkout_date' type="text" class="form-control date-input bg-white" data-value="<?= \Web\Params::get('checkout_date_submit') ?>" />
          </div>

          <div class="mb-3">
            <label for='order_status' class="form-label">Estado</label>

            <select class="form-control" id='order_status' name='order_status'>
              <option></option>
              <?php foreach (\Models\BookingOrder::STATUSES as $key => $value) : ?>
                <option <?= $key == \Web\Params::get('order_status') ? "selected='selected'" : null ?> value='<?= $key ?>'><?= htmlspecialchars($value) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <button type="submit" class="btn btn-primary me-3"><i class="fa fa-search"></i> Buscar</button>
            <button form="reset-form" class="btn btn-warning"><i class="fa fa-times"></i> Limpiar</button>
          </div>
        </form>
      </div>
    </div>

    <table class="table table-hover">
      <thead>
        <tr>
          <?php foreach ($this->resourceManager()->listableAttributes() as $attribute) : ?>
            <th>
              <?= $this->resourceManager()->labelFor($attribute) ?>
            </th>
          <?php endforeach; ?>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; ?>
        <?php foreach ($this->resourceManager()->items() as $item) : ?>
          <?php $total += $item->total ?>
          <tr>
            <td>
              <?= $item->formattedId() ?>
            </td>
            <td>
              <?= $item->user()->fullName(); ?>
            </td>
            <td>
              <?= statusLabel($item->status) ?>
            </td>
            <td>
              <?= $item->order_date ?>
            </td>
            <td>
              <?= $item->checkin_date ?>
            </td>
            <td>
              <?= $item->checkout_date ?>
            </td>
            <td>
              <?= number_format($item->total, 2) ?>
            </td>
            <td>
              <?php foreach ($this->resourceManager()->listableActions() as $action) : ?>
                <?= $this->resourceManager()->renderModelAction($item, $action, 'index') ?>
              <?php endforeach; ?>
            </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan='6'><strong>Total</strong></td>
          <td><strong><?= number_format($total, 2) ?></strong></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>