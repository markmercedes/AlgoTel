<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class TextAttribute extends Base
{
  function renderForm($options = [])
  {
    $form = $options['form'];
    $placeholder = Arr::get($options, 'placeholder');
?>
    <div class="mb-3">
      <label for='<?= $id ?>' class="form-label"><?= $this->label ?></label>
      <textarea class="form-control" id='<?= $form->elementId($this->attribute) ?>' name='<?= $this->attribute ?>' placeholder='<?= $placeholder ?>' form='<?= $form->formId() ?>'><?= htmlspecialchars($this->model->{$this->attribute}) ?></textarea>
    </div>
<?php
  }
}
