<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class DateAttribute extends Base
{
  function renderForm($options = [])
  {
    $form = $options['form'];
    $id = $form->elementId($this->attribute);
?>
    <div class="mb-3">
      <label for='<?= $id ?>' class="form-label"><?= $this->label ?></label>
      <input value='<?= htmlspecialchars($this->model->{$this->attribute}) ?>' type="text" class="form-control model-date-input bg-white" id='<?= $id ?>' name='<?= $this->attribute ?>' form='<?= $form->formId() ?>'>
    </div>
<?php
  }
}
