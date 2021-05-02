<?php

namespace Models;

use stdClass;

trait FieldTypeSupport
{
  function writeJson($value)
  {
    return json_encode($value);
  }

  protected function readJson($value)
  {
    if (!$value) {
      return new stdClass();
    }

    if (gettype($value) == 'string') {
      return json_decode($value);
    }

    return $value;
  }

  protected function readAttribute($attribute, $value)
  {
    if (in_array($attribute, array_keys(static::FIELD_TYPES))) {
      return $this->readJson($value);
    }

    return $value;
  }

  protected function writeAttribute($attribute, $value)
  {
    if (in_array($attribute, array_keys(static::FIELD_TYPES))) {
      switch (static::FIELD_TYPES[$attribute]) {
        case 'Json':
          return $this->writeJson($value);
        case 'FileGallery':
          return $this->writeGallery($attribute, $value);
      }
    }

    return $value;
  }

  protected function writeGallery($attribute, $value)
  {
    $files = $this->readJson($value);
    $uploadedFiles = [];

    $today = date("Ymd");

    foreach ($files as $file) {
      $file = (object) $file;
      $tmpFile = $file->tmp_name;

      $directory = uploadsPath() . DS  . static::$tableName . DS . $attribute . DS . $today;
      $targetPath = $directory . DS . $file->name;

      if (!file_exists($directory)) {
        mkdir(directory: $directory, recursive: true);
      }

      move_uploaded_file($tmpFile, $targetPath);

      $uploadedFiles[] = implode('/', [
        static::$tableName,
        $attribute,
        $today,
        $file->name
      ]);
    }

    $results = array_merge($uploadedFiles, $this->initialAttributes[$attribute]);

    return $this->writeJson($results);
  }
}
