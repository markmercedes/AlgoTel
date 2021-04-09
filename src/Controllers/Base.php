<?php

namespace Controllers;

use Web\Params;

class Base
{
  public static function dispatchController()
  {
    $controllerName = Params::pathPart(1);
    $action = Params::pathPart(2);

    if ($controllerName) $controllerName = 'Users';
    if ($action) $action = 'index';

    $controllerClass = implode('\\', [
      'Controllers',
      $controllerName . 'Controller'
    ]);

    $controller = new $controllerClass();
    $controller->dispatch($action);
  }
}
