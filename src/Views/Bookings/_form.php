<?php

use Web\Params;
?>
<div class="booking-form">
  <form action="/Rooms/index">
    <div class="check-date">
      <label for="date-in">Check In:</label>
      <input type="text" class="date-input" name="date-in" id="date-in" data-value="<?= Params::get('date-in_submit', date('Y-m-d', strtotime("+2 days"))) ?>">
      <i class="icon_calendar"></i>
    </div>
    <div class="check-date">
      <label for="date-out">Check Out:</label>
      <input type="text" class="date-input" name="date-out" id="date-out" data-value="<?= Params::get('date-out_submit', date('Y-m-d', strtotime("+3 days"))) ?>">
      <i class="icon_calendar"></i>
    </div>
    <div class="select-option">
      <label for="guest">Adultos:</label>
      <?php select_tag('guests', 'guests', selected: Params::get('guests', '2'), options: ['0' => '0 adultos', '1' => '1 adulto', '2' => '2 adultos', '2' => '2 adultos', '3' => '3 adultos', '4' => '4 adultos', '5' => '5 adultos']) ?>
    </div>
    <div class="select-option">
      <label for="room">Niños:</label>
      <?php select_tag('children', 'children', selected: Params::get('children'), options: ['0' => '0 niños', '1' => '1 niño', '2' => '2 niños', '2' => '2 niños', '3' => '3 niños', '4' => '4 niños', '5' => '5 niños']) ?>
    </div>
    <div class="d-grid gap-2">
      <button class="btn btn-primary" type="submit">Revisar disponibilidad</button>
    </div>
  </form>
</div>