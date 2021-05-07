<?php

namespace Controllers;

class SmallCartController extends Base
{
  public function index()
  {
    $this->renderPartial(
      'index',
      []
    );
  }
}
