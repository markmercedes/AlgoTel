<?php

namespace ModelActions;

class DestroyAction extends Base
{
  function render($context, $options = [])
  {
    $resourceUrl = linkTo([$this->resourcePath, 'destroy']);
?>
    <a class="btn btn-outline-danger btn-destroy-item" data-resource-id='<?= $this->model->id ?>' href=<?= $resourceUrl ?>><i class="fa fa-trash"></i>
    </a>
<?php
  }
}
