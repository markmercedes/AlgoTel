<?php

namespace ModelActions;

class CancelAction extends Base
{
  function render($context, $options = [])
  {

    $resourceUrl = linkTo([$this->resourcePath]);
?>
    <a class="btn btn-danger btn-cancel-item" href=<?= $resourceUrl ?>><i class="fa fa-times"></i>
      Cancel
    </a>
<?php
  }
}
