<?php

use Web\Params;
?>
<div class="booking-form">
  <form action="#">
    <div class="check-date">
      <label for="date-in">Check In:</label>
      <input type="text" class="date-input" id="date-in" name="date-in" data-value="<?= Params::get('date-in_submit', date('Y-m-d', strtotime("+2 days"))) ?>">
      <i class="icon_calendar"></i>
    </div>
    <div class="check-date">
      <label for="date-out">Check Out:</label>
      <input type="text" class="date-input" id="date-out" name="date-out" data-value="<?= Params::get('date-out_submit', date('Y-m-d', strtotime("+3 days"))) ?>">
      <i class="icon_calendar"></i>
    </div>
    <div class="select-option">
      <label for="guest">Adultos:</label>
      <select id="guest" class="form-select">
        <option value="1">1 adulto</option>
        <option selected="selected" value="2">2 adultos</option>
        <option value="3">3 adultos</option>
        <option value="4">4 adultos</option>
        <option value="5">5 adultos</option>
        <option value="6">6 adultos</option>
        <option value="7">7 adultos</option>
      </select>
    </div>
    <div class="select-option">
      <label for="room">Niños:</label>
      <select id="room" class="form-select">
        <option selected="selected" value="0">0 niño</option>
        <option value="1">1 niño</option>
        <option value="2">2 niños</option>
        <option value="2">2 niños</option>
        <option value="3">3 niños</option>
        <option value="4">4 niños</option>
        <option value="5">5 niños</option>
      </select>
    </div>
    <div class="d-grid gap-2">
      <button class="btn btn-primary" type="submit">Revisar disponibilidad</button>
    </div>
  </form>
</div>