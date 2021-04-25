<?php

namespace ResourceManagers;

use Utils\Arr;

class Base
{
  const MODEL_CLASS = '';
  const EDITABLE_ATTRIBUTES = [];
  const LISTABLE_ATTRIBUTES = [];
  const LISTABLE_ACTIONS = ['edit', 'destroy'];
  const ATTRIBUTE_TYPES = [];


  protected $controller;

  function labelFor($attribute)
  {
    $attrMeta = static::ATTRIBUTE_TYPES[$attribute] ?? [];

    return Arr::get($attrMeta, 'label', $attribute);
  }

  function __construct($controller)
  {
    $this->controller = $controller;
  }

  function resourcePath()
  {
    return $this->controller->currentRoute();
  }

  function listableAttributes()
  {
    return static::LISTABLE_ATTRIBUTES;
  }

  function editableAttributes()
  {
    return static::EDITABLE_ATTRIBUTES;
  }

  function listableActions()
  {
    return static::LISTABLE_ACTIONS;
  }

  function build($attributes = [])
  {
    $modelClass = static::MODEL_CLASS;

    return new $modelClass($attributes);
  }

  function find($id)
  {
    $modelClass = static::MODEL_CLASS;

    return $modelClass::find($id);
  }


  function fieldFor($model, $attribute)
  {
    $attrMeta = static::ATTRIBUTE_TYPES[$attribute] ?? [];

    $type = Arr::get($attrMeta, 'type', 'String');

    $attrClass = '\\ResourceManagers\\Attributes\\' . $type . 'Attribute';

    return new $attrClass($model, $attribute, $attrMeta);
  }

  function model()
  {
    $modelClass = static::MODEL_CLASS;

    return forward_static_call_array([$modelClass, 'where'], func_get_args());
  }

  function items()
  {
    return $this->model();
  }

  function renderModelAction($model, $action, $context, $options = [])
  {

    $className = ucfirst($action) . 'Action';
    $fullClassName = "\\ModelActions\\$className";

    $modelAction = new $fullClassName($model, $this->resourcePath());

    return $modelAction->render($context, $options);
  }
}
