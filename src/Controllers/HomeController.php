<?php

namespace Controllers;

class HomeController extends Base
{
  public function index()
  {
    $this->render(
      'index',
      []
    );
  }
}
