<?php

namespace ModelActions;

class NewAction extends Base
{
  function render($context, $options = [])
  {

    $resourceUrl = linkTo([$this->resourcePath, 'new']);
?>
    <a class="btn btn-success btn-edit-item" href=<?= $resourceUrl ?>><i class="fa fa-plus"></i>
      Agregar
    </a>
<?php
  }
}
