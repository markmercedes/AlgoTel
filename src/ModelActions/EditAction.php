<?php

namespace ModelActions;

class EditAction extends Base
{
  function render($context, $options = [])
  {
    $resourceUrl = linkTo([$this->resourcePath, 'edit'], ['id' => $this->model->id]);
?>
    <a class="btn btn-outline-primary btn-edit-item" href=<?= $resourceUrl ?>><i class="fa fa-edit"></i>
    </a>
<?php
  }
}
