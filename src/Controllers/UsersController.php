<?php

namespace Controllers;

use Config\App;

class UsersController extends Base
{
  public function dispatch($action)
  {
    return $this->{$action}();
  }

  public function index()
  {
    $this->render(
      'index',
      []
    );
  }

  private function yield($viewPath)
  {
    require $viewPath;
  }

  private function render($viewName)
  {
    $path = explode('\\', __CLASS__);
    $className = array_pop($path);

    $scope = str_replace('Controller', '', $className);
    $mainContent = App::viewsPath() . DIRECTORY_SEPARATOR . $scope . DIRECTORY_SEPARATOR . $viewName . '.php';

    require App::viewsPath() . DIRECTORY_SEPARATOR . 'Layout' . DIRECTORY_SEPARATOR . 'Application.php';
  }
}
