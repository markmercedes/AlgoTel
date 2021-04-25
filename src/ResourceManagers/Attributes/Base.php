<?php

namespace ResourceManagers\Attributes;

use Utils\Arr;

class Base
{
  protected $model, $attribute, $attrMeta;

  function __construct($model, $attribute, $attrMeta)
  {
    $this->model = $model;
    $this->attribute = $attribute;
    $this->attrMeta = $attrMeta;
    $this->label = Arr::get($attrMeta, 'label', $attribute);
  }
}
