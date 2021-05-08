<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class SelectAttribute extends Base
{
  function renderForm($options = [])
  {
    $form = $options['form'];
    $items = $this->attrMeta['items'];
    $placeholder = Arr::get($options, 'placeholder');
    $id = $form->elementId($this->attribute);
?>
    <div class="mb-3">
      <label for='<?= $id ?>' class="form-label"><?= $this->label ?></label>

      <select class="form-control" id='<?= $id ?>' name='<?= $this->attribute ?>' form='<?= $form->formId() ?>'>
        <option><?= $placeholder ?></option>
        <?php foreach ($items as $key => $value) : ?>
          <option <?= $key == $this->model->{$this->attribute} ? "selected='selected'" : null ?> value='<?= $key ?>'><?= htmlspecialchars($value) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
<?php
  }
}
