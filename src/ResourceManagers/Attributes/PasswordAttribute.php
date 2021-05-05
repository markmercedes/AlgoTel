<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class PasswordAttribute extends Base
{
  static function serialize($value)
  {
    if (!empty($value)) {
      return sha1($value);
    }
  }

  function renderForm($options = [])
  {
    $form = $options['form'];
    $placeholder = Arr::get($options, 'placeholder');
    $id = $form->elementId($this->attribute);
?>
    <div class="mb-3">
      <label for='<?= $id ?>' class="form-label"><?= $this->label ?></label>
      <input autocomplete="off" value='' type="password" class="form-control" id='<?= $id ?>' name='<?= $this->attribute ?>' placeholder='<?= $placeholder ?>' form='<?= $form->formId() ?>'>
    </div>
<?php
  }
}
