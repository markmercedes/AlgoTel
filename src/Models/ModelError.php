<?php

namespace Models;

class ModelError
{
  public $errorType;
  public $attribute;
  public $value;

  function __construct($attribute, $errorType, $value = null)
  {
    $this->attribute = $attribute;
    $this->errorType = $errorType;
    $this->value = $value;
  }

  function getMessage($label)
  {
    return match ($this->errorType) {
      'UNIQUE_KEY' => "valor '{$this->value}' es duplicado para '{$label}', ya existe otro record con ese valor",
      'REQUIRED' => "'{$label}' require un valor",
    };
  }
}
