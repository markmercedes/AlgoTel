<?php

namespace Controllers\Admin;

use Db\Connection;
use Web\Params;

class DashboardController extends AdminBaseController
{
  protected $bookingsPerDay;
  protected $bookingsByStatus;

  function index()
  {
    $this->validateUser();
    contentFor('title', 'Dashboard');

    $this->bookingsPerDay = $this->bookingsPerDay();
    $this->bookingsByStatus = $this->bookingsByStatus();

    $this->render('index');
  }

  private function bookingsByStatus()
  {
    $sql = "SELECT STATUS as order_status, COUNT(1) orders FROM bookings GROUP BY STATUS";
    return Connection::query($sql);
  }

  private function bookingsPerDay()
  {
    $dateFrom = $this->dateFrom();
    $dateTo = $this->dateTo();

    $sql = "SELECT order_date, COUNT(1) as orders, SUM(total) AS total FROM bookings WHERE STATUS IN('complete', 'fulfilled') AND order_date BETWEEN :dateFrom AND :dateTo GROUP BY order_date ORDER BY order_date";
    return Connection::query($sql, ['dateFrom' => $dateFrom, 'dateTo' => $dateTo]);
  }

  function dateFrom()
  {
    return Params::get('date-from_submit', date('Y-m-d', strtotime("-30 days")));
  }

  function dateTo()
  {
    return Params::get('date-to_submit', date('Y-m-d'));
  }
}
