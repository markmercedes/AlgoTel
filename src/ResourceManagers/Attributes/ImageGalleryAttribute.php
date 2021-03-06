<?php

namespace ResourceManagers\Attributes;

use stdClass;
use Utils\Arr;

class ImageGalleryAttribute extends Base
{
  function renderForm($options = [])
  {
    $images =     $this->model->{$this->attribute};
?>
    <div class="row">
      <?php foreach ($images as $image) : ?>
        <div class="col-3">
          <img class="img-thumbnail" src='<?= uploadsUrl($image) ?>' />
        </div>
      <?php endforeach; ?>
    </div>
    <?php

    $entries = [0, 1, 3, 4, 5, 6, 7];
    ?>
    <div class="my-3">
      <fieldset class="py-3">
        <legend><?= $this->label ?></legend>
        <div class="mb-3 row">
          <?php foreach ($entries as $entry) : ?>
            <div class="col-12 upload-preview">
              <img class="img-thumbnail" />
              <input class="preview-file-on-upload" type="file" name='<?= "{$this->attribute}[$entry]" ?>' />
            </div>
          <?php endforeach; ?>
        </div>
      </fieldset>
    </div>
<?php
  }
}
