<?php

namespace Controllers\Admin;

use Config\App;
use Web\Params;

class AdminBaseController extends \Controllers\Base
{
  const RESOURCE_MANAGER = '';

  protected function renderLayout($mainContent)
  {
    require App::viewsPath('Layout', 'backend', 'Application');
  }

  protected function validateUser()
  {
    if (!$this->isAdmin()) {
      header("Location: /Session");
      exit();
    }
  }

  function index()
  {
    $this->validateUser();
    contentFor('title', $this->resourceManager()->resourcesLabel());

    parent::index();
  }

  private $model;

  public function model()
  {
    return $this->model ??= $this->findModel();
  }

  private function modelId()
  {
    return Params::get('id');
  }

  private function findModel()
  {
    if (!$this->modelId()) {
      return $this->resourceManager()->build();
    }

    return $this->resourceManager()->find($this->modelId());
  }

  public function new()
  {
    $this->validateUser();
    contentFor('title', 'Crear ' . $this->resourceManager()->resourceLabel());

    $this->render(
      'new',
      []
    );
  }

  public function edit()
  {
    $this->validateUser();
    contentFor('title', 'Editar ' . $this->resourceManager()->resourceLabel());

    $this->render(
      'edit',
      []
    );
  }

  public function destroy()
  {
    $this->validateUser();

    $id = Params::post('id');
    $model = $this->resourceManager()->find($id);

    $model->destroy();

    $resourceUrl = linkTo([$this->currentRoute()]);

    header("Location: $resourceUrl");
    exit();
  }

  public function params()
  {
    $params = [];

    $attributes = $this->resourceManager()->editableAttributes();
    $inputParams = Params::post();

    foreach ($inputParams as $param => $value) {
      if (in_array($param, $attributes)) {
        $params[$param] = $this->resourceManager()->parseInputFor($param, $value);
      }
    }

    return $params;
  }

  public function update()
  {
    $this->validateUser();
    $this->model()->setAttributes($this->params());
    $this->model()->save();

    if ($this->model()->save()) {
      $resourceUrl = linkTo([$this->currentRoute(), 'edit'], ['id' => $this->model()->id]);

      header("Location: $resourceUrl");
      exit();
    } else {
      $this->edit();
    }
  }

  public function create()
  {
    $this->validateUser();
    $this->model()->setAttributes($this->params());

    if ($this->model()->save()) {
      $resourceUrl = linkTo([$this->currentRoute(), 'edit'], ['id' => $this->model()->id]);

      header("Location: $resourceUrl");
      exit();
    } else {
      $this->new();
    }
  }

  public function saveOrUpdatePath()
  {
    if ($this->model->isNewRecord()) {
      return linkTo([$this->currentRoute(), 'create']);
    } else {
      return linkTo([$this->currentRoute(), 'update'], ['id' => $this->model->id]);
    }
  }

  private $resourceManager;

  function resourceManager()
  {
    $resourceManagerClass = static::RESOURCE_MANAGER;
    return $this->resourceManager ??= new $resourceManagerClass($this);
  }
}
