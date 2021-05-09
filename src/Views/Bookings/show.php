<section class="hero-section">
  <div class="container">
    <div class="row">
      <div class="row">
        <div class="col mb-5">
          <?= $this->order->user()->fullName() ?>
          <br />
          Orden #: <?= $this->order->formattedId() ?>
          <br />
          <?= $this->order->orderDate() ?>
          <br />
          <div class="mb-3">
            <?= statusLabel($this->order->status) ?>
          </div>
          <?php if ($this->order->customer_notes) : ?>
            <strong>Anotaciones de Cliente</strong>
            <p><?= $this->order->customer_notes ?></p>
          <?php endif; ?>

          <?php if ($this->order->staff_notes) : ?>
            <strong>Anotaciones de Staff</strong>
            <p><?= $this->order->staff_notes ?></p>
          <?php endif; ?>

          <?php if ($this->order->isSancelled()) : ?>
            <strong>Cancelada en: </strong>
            <span><?= $this->order->cancelled_at ?></span>
            <p><?= $this->order->cancellation_notes ?></p>
          <?php endif; ?>
          </p>
        </div>
      </div>

      <?php foreach ($this->order->orderItems() as $item) : ?>
        <div class="row py-2 border-bottom">
          <div class="col-8">
            <?= $item->room->name ?>
            <br />
            <?= $item->checkin_date ?> - <?= $item->checkout_date ?>
          </div>
          <div class="col text-end">
            <?= number_format($item->total, 2) ?>
          </div>
        </div>
      <?php endforeach; ?>

      <div class="row bg-light py-3">
        <div class="col-8">
          <strong>Total:</strong>
        </div>
        <div class="col text-end">
          <strong><?= number_format($this->order->total, 2) ?></strong>
        </div>
      </div>
    </div>
  </div>
</section>