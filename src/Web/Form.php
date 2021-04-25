<?php

namespace Web;

class Form
{
  static function for($model, $url, $html = [])
  {
    $form = new static($model, $url, $html);
    $form->openTag();
    return $form;
  }

  private $model;
  private $url;
  private $html;

  function __construct($model, $url, $html)
  {
    $this->model = $model;
    $this->url = $url;
    $this->html = $html;
  }

  function elementId($attribute)
  {
    return $this->formId() . '-' . parameterize($attribute);
  }

  function elementName($attribute)
  {
    return $this->formName() . '-' . parameterize($attribute);
  }

  function formId()
  {
    return $this->formName() . '-' . $this->model->id;
  }

  function formName()
  {
    return parameterize(get_class($this->model));
  }

  function htmlAttributes()
  {
    $attributes = '';

    foreach ($this->html as $attribute => $value) {
      $attributes .= "$attribute='$value' ";
    }

    return $attributes;
  }

  function openTag()
  {
?>
    <form method="post" name='<?= $this->formName() ?>' id='<?= $this->formId() ?>' action='<?= $this->url ?>' <?= $this->htmlAttributes() ?>>
    <?php
  }

  function closeTag()
  {
    ?>
    </form>
<?php
  }
}
?>