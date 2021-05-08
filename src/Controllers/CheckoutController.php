<?php

namespace Controllers;

use Booking\BookingCart;
use Models\BookingOrder;
use Web\Params;

class CheckoutController extends Base
{
  public function create()
  {
    $bookingCart = new BookingCart();

    if ($this->currentUser() && $bookingCart->hasItems()) {
      $booking = new BookingOrder();
      $booking->notes = Params::post('notes');
      $booking->user_id = $this->currentUserID();
      $booking->buildFromBookingCart($bookingCart);

      $bookingCart->clear();

      $location = linkTo(['Bookings', 'show'], ['id' => $booking->id]);

      header("Location: $location");
      exit();
    } else {
      $location = linkTo(['BookingCart']);

      header("Location: $location");
      exit();
    }
  }
}
