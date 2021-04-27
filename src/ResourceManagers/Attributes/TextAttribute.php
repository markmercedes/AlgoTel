<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class TextAttribute extends Base
{
  function renderForm($options = [])
  {
    $form = $options['form'];
    $placeholder = Arr::get($options, 'placeholder');
    $rows = Arr::get($this->attrMeta, 'rows', 5);
    $id = $form->elementId($this->attribute);
?>
    <div class="mb-3">
      <label for='<?= $id ?>' class="form-label"><?= $this->label ?></label>
      <textarea rows='<?= $rows ?>' class="form-control" id='<?= $id ?>' name='<?= $this->attribute ?>' placeholder='<?= $placeholder ?>' form='<?= $form->formId() ?>'><?= htmlspecialchars($this->model->{$this->attribute}) ?></textarea>
    </div>
<?php
  }
}
