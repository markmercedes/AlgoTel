<?php

namespace Controllers;

use Config\App;
use Models\User;
use Web\Params;
use Utils\Arr;

class SessionController extends Base
{
  function index()
  {
    contentFor('title', 'Login');
    $this->sendHomeIfAlreadyLoggedIn();

    parent::index();
  }
  function create()
  {
    $this->sendHomeIfAlreadyLoggedIn();

    $results = User::where([
      "status = 'active'",
      'email = ?',
      'password = ?'
    ], [Params::post('email'), sha1(Params::post('password'))], limit: 1);

    if (count($results) && $results[0]->email == Params::post('email')) {
      $_SESSION['USER_ID'] = $results[0]->id;
      $this->redirectToReturnUrl();
    } else {
      $this->errors[] = 'Login invalido';

      parent::index();
    }
  }

  function destroy()
  {
    session_destroy();

    $this->redirectToReturnUrl();

    exit();
  }

  function sendHomeIfAlreadyLoggedIn()
  {
    if ($this->currentUser()) {
      header("Location: /");
      exit();
    }
  }
}
