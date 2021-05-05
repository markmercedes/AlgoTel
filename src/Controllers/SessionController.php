<?php

namespace Controllers;

use Config\App;
use Models\User;
use Web\Params;
use Utils\Arr;

class SessionController extends Base
{
  function create()
  {
    $results = User::where([
      'email = ?',
      'password = ?'
    ], [Params::post('email'), sha1(Params::post('password'))], limit: 1);

    if (count($results) && $results[0]->email == Params::post('email')) {
      $_SESSION['USER_ID'] = $results[0]->id;
      $this->redirectToReturnUrl();
    } else {
      header("Location: /Session");
      exit();
    }
  }

  function destroy()
  {
    session_destroy();

    $this->redirectToReturnUrl();

    exit();
  }
}
