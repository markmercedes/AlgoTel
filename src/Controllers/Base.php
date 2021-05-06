<?php

namespace Controllers;

use Config\App;
use Models\User;
use Web\Params;
use Utils\Arr;

class Base
{
  private $currentUser = null;
  protected $errors = [];

  function currentUserID()
  {
    if (isset($_SESSION['USER_ID'])) {
      return $_SESSION['USER_ID'];
    }
  }

  function redirectToReturnUrl()
  {
    $returnUrl = Params::get('ReturnUrl', '/');

    if ($returnUrl == '/Registrations/create') {
      $returnUrl = '/';
    }

    header("Location: $returnUrl");
    exit();
  }

  function currentUser()
  {
    if ($this->currentUserID()) {
      return $this->currentUser ??= User::find($this->currentUserID());
    }
  }

  function isAdmin()
  {
    if ($this->currentUser()) {
      return $this->currentUser()->isAdmin();
    }
  }

  public function index()
  {
    $this->render(
      'index',
      []
    );
  }

  public function new()
  {
    $this->render(
      'new',
      []
    );
  }

  public function dispatch($action)
  {
    return $this->{$action}();
  }

  protected function yield($viewPath)
  {
    require $viewPath;
  }

  public function renderPartial($viewName)
  {
    return $this->render($viewName, layout: false);
  }


  function collectLookups()
  {
    $lookups = [$this->viewLookupContext()];

    $parentClass = get_parent_class($this);

    while ($parentClass) {
      if (method_exists($parentClass, 'viewLookupContext')) {
        $instance = new $parentClass;
        $lookups[] = $instance->viewLookupContext();
      }
      $parentClass = get_parent_class($instance);
    }

    return $lookups;
  }

  public function viewLookupContext()
  {
    $x  =  str_replace('Controllers\\', '', get_class($this));
    $x = str_replace('Controller', '', $x);
    $x = str_replace('\\', DIRECTORY_SEPARATOR, $x);

    return $x;
  }

  public function viewScope()
  {
    $path = explode('\\', get_class($this));
    $className = array_pop($path);
    $scope = str_replace('Controller', '', $className);

    return $scope;
  }

  public function scopeFor($viewName)
  {
    $absoluteScope = $viewName[0] == '/';

    if (!$absoluteScope) {
      return $this->viewScope();
    }
  }

  protected function render($viewName, $options = [], $layout = true)
  {
    $_viewName = str_replace('/', DIRECTORY_SEPARATOR, $viewName);

    $lookups = $this->collectLookups();
    $mainContent = null;

    if ($viewName[0] == '/') {
      $mainContent = App::viewsPath(ltrim($viewName, '/'));
    } else {
      foreach ($lookups as $lookup) {
        if (file_exists(App::viewsPath($lookup, $_viewName))) {
          $mainContent = App::viewsPath($lookup, $_viewName);
          break;
        }
      }
    }

    if (!$mainContent) {
      throw new \RuntimeException();
    }

    if ($layout) {
      $this->renderLayout($mainContent);
    } else {
      $this->yield($mainContent);
    }
  }

  public function currentRoute()
  {
    $className = str_replace('Controllers\\', '', get_class($this));
    $route = str_replace('Controller', '', $className);

    return implode('/', explode('\\', $route));
  }

  protected function renderLayout($mainContent)
  {
    require App::viewsPath('Layout', 'frontend', 'Application');
  }

  public static function currentControllerNamespace()
  {
    if (Params::pathSize() >= 3 && Params::pathPart(1) == 'Admin') {
      return Params::pathPart(1);
    }
  }

  const VALID_ACTION_METHODS = ['index', 'show', 'new', 'create', 'edit', 'destroy', 'update'];

  public function validActionMethods()
  {
    return static::VALID_ACTION_METHODS;
  }

  public static function dispatchController()
  {
    $controllerNamespace = static::currentControllerNamespace();
    $controllerPathIndex = 1;
    $actionPathIndex = 2;

    if ($controllerNamespace) {
      $controllerPathIndex = 2;
      $actionPathIndex = 3;
    }

    $controllerName = Params::pathPart($controllerPathIndex);
    $action = Params::pathPart($actionPathIndex);

    if (!$controllerName) $controllerName = 'Home';
    if (!$action) $action = 'index';

    $controllerClass = implode('\\', Arr::withoutEmpty([
      'Controllers',
      $controllerNamespace,
      $controllerName . 'Controller'
    ]));

    $controller = new $controllerClass();

    if (!in_array($action, $controller->validActionMethods())) {
      throw new InvalidActionMethodRoutingException($action);
    }

    $controller->dispatch($action);
  }
}

class InvalidActionMethodRoutingException extends \Exception
{
}
