<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class BelongsToAttribute extends Base
{
  function items()
  {
    $modelClass =  $this->attrMeta['modelClass'];

    return forward_static_call_array([$modelClass, 'where'], []);
  }

  function renderForm($options = [])
  {
    $form = $options['form'];
    $placeholder = Arr::get($options, 'placeholder');
    $id = $form->elementId($this->attribute);
?>
    <div class="mb-3">
      <label for='<?= $id ?>' class="form-label"><?= $this->label ?></label>

      <select class="form-control" id='<?= $id ?>' name='<?= $this->attribute ?>' form='<?= $form->formId() ?>'>
        <option><?= $placeholder ?></option>
        <?php foreach ($this->items() as $item) : ?>
          <option <?= $item->id == $this->model->{$this->attribute} ? "selected='selected'" : null ?> value='<?= $item->id ?>'><?= htmlspecialchars($item->name) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
<?php
  }
}
