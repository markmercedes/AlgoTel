<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class MultiPriceConfigAttribute extends Base
{
  function renderForm($options = [])
  {
    $form = $options['form'];
    $placeholder = Arr::get($options, 'placeholder');
    $id = $form->elementId($this->attribute);

    $entries = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $priceConfig = $this->model->{$this->attribute};
    $times = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
?>
    <div class="my-3">
      <fieldset class="py-3">
        <legend><?= $this->label ?></legend>
        <div class="mb-3">
          <?php foreach ($times as $time) : ?>
            <table class="table">
              <tr>
                <?php foreach ($entries as $entry) : ?>
                  <td>
                    <strong><?= $entry ?></strong>
                    <input value='<?= htmlspecialchars($priceConfig->{$entry}) ?>' type="number" class="form-control" id='<?= $id ?>' name='<?= "{$this->attribute}[$entry][$time]" ?>' placeholder='<?= $placeholder ?>' form='<?= $form->formId() ?>'>
                  </td>
                <?php endforeach; ?>
              </tr>
            </table>
          <?php endforeach; ?>
        </div>
      </fieldset>
    </div>
<?php
  }
}
