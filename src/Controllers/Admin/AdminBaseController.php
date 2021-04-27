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

  function index()
  {
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
    contentFor('title', 'Crear ' . $this->resourceManager()->resourceLabel());

    $this->render(
      'new',
      []
    );
  }

  public function edit()
  {
    contentFor('title', 'Editar ' . $this->resourceManager()->resourceLabel());

    $this->render(
      'edit',
      []
    );
  }

  public function update()
  {
    $this->model()->setAttributes(Params::post());
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
    $this->model()->setAttributes(Params::post());

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
