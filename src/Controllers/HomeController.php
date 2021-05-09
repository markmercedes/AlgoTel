<?php

namespace Controllers;

class HomeController extends Base
{
  public function index()
  {
    contentFor('title', 'Eden Roc Cap Cana');

    $this->render(
      'index',
      []
    );
  }
}
