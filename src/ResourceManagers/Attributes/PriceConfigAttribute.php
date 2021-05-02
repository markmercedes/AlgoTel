<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class PriceConfigAttribute extends Base
{
  function renderForm($options = [])
  {
    $form = $options['form'];
    $placeholder = Arr::get($options, 'placeholder');
    $id = $form->elementId($this->attribute);

    $entries = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $priceConfig = $this->model->{$this->attribute};
?>
    <div class="my-3">
      <fieldset class="py-3">
        <legend><?= $this->label ?></legend>
        <div class="mb-3">
          <table class="table">
            <tr>
              <?php foreach ($entries as $entry) : ?>
                <td>
                  <strong><?= $entry ?></strong>
                  <input value='<?= htmlspecialchars($priceConfig->{$entry}) ?>' type="number" class="form-control" id='<?= $id ?>' name='<?= "{$this->attribute}[$entry]" ?>' placeholder='<?= $placeholder ?>' form='<?= $form->formId() ?>'>
                </td>
              <?php endforeach; ?>
            </tr>
          </table>
        </div>
      </fieldset>
    </div>
<?php
  }
}
