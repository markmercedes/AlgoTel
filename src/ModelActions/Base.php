<?php

namespace ModelActions;

class Base
{
  protected $model;
  protected $resourcePath;

  function __construct($model, $resourcePath)
  {
    $this->model = $model;
    $this->resourcePath = $resourcePath;
  }

  function render($context, $options = [])
  {
    $resourceUrl = implode('/', [$this->resourcePath, $this->model->id, 'edit']);
?>
    <a class="btn btn-outline-primary btn-edit-item" href=<?= $resourceUrl ?>><i class="fa fa-edit"></i>
    </a>
<?php
  }
}
