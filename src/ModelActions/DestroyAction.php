<?php

namespace ModelActions;

class DestroyAction extends Base
{
  function render($context, $options = [])
  {
    $resourceUrl = implode('/', [$this->resourcePath, $this->model->id, 'destroy']);
?>
    <a class="btn btn-outline-danger btn-edit-item" href=<?= $resourceUrl ?>><i class="fa fa-trash"></i>
    </a>
<?php
  }
}
