<?php

namespace ModelActions;

use Utils\Arr;

class SaveAction extends Base
{
  function render($context, $options = [])
  {
    $form = $options['form'];
?>
    <button name="button" type="submit" class="btn btn-primary btn-save-item" form='<?= $form->formId() ?>'><i class="fa fa-save"></i>
      Guardar
    </button>
<?php
  }
}
