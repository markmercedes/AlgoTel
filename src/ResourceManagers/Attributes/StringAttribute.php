<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class StringAttribute extends Base
{
  function renderForm($options = [])
  {
    $form = $options['form'];
    $placeholder = Arr::get($options, 'placeholder');
    $id = $form->elementId($this->attribute);
?>
    <div class="mb-3">
      <label for='<?= $id ?>' class="form-label"><?= $this->label ?></label>
      <input value='<?= htmlspecialchars($this->model->{$this->attribute}) ?>' type="text" class="form-control" id='<?= $id ?>' name='<?= $this->attribute ?>' placeholder='<?= $placeholder ?>' form='<?= $form->formId() ?>'>
    </div>
<?php
  }
}
