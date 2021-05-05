<?php

namespace Controllers;

class AdminController extends Base
{
  function index()
  {
    header("Location: /Admin/Rooms");
    exit();
  }
}
