<?php

namespace Controllers;

use Config\App;
use Controllers\Admin\AdminBaseController;
use Models\User;
use Web\Params;
use Utils\Arr;

class RegistrationsController extends AdminBaseController
{
  const RESOURCE_MANAGER = 'ResourceManagers\RegistrationManager';
  const VALID_ACTION_METHODS = ['new', 'create'];

  protected function validateUser()
  {
    $this->sendHomeIfAlreadyLoggedIn();
  }

  protected function renderLayout($mainContent)
  {
    require App::viewsPath('Layout', 'frontend', 'Application');
  }

  public function create()
  {
    $this->validateUser();
    $this->model()->setAttributes($this->params());

    if ($this->model()->save()) {
      $_SESSION['USER_ID'] = $this->model()->id;
      $this->redirectToReturnUrl();
      exit();
    } else {
      $this->new();
    }
  }

  function sendHomeIfAlreadyLoggedIn()
  {
    if ($this->currentUser()) {
      header("Location: /");
      exit();
    }
  }
}
