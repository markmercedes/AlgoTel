<script>
  $(function() {
    $('#cancel_booking_form').submit(function(e) {
      if (confirm('Esta seguro de que desea cancelar esta reservación?')) {

      } else {
        e.preventDefault();
      }
    });
  })
</script>

<section class="hero-section">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center mx-auto mb-5">
        <h2>Cancelar Booking #<?= $this->order->formattedId() ?></h2>
      </div>
      <div class="col-lg-6 mx-auto">
        <form action='/CancelBooking/destroy' method='post' id='cancel_booking_form'>
          <input type='hidden' name='id' value='<?= $this->order->id ?>' />

          <div class="mb-3">
            <label for='cancellation_notes' class="form-label">
              <h4>Motivos de cancelación</h4>
            </label>
            <textarea required='required' rows='10' class="form-control" id='cancellation_notes' name='cancellation_notes' form='cancel_booking_form'></textarea>
          </div>

          <div class="mb-3">
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-lg btn-danger" id="cancel-order-button"> <i class='fa fa-times'></i> Cancelar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>