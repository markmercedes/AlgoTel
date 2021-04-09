<?php

namespace Db;

class TableMetadata
{
  private $fields = [];

  function __construct($tableName)
  {
    $this->load($tableName);
  }

  public function properties()
  {
    return array_map(function ($item) {
      return $item->name;
    }, $this->fields);
  }

  public function primaryKey()
  {
    foreach ($this->fields as $field) {
      if ($field->primaryKey) {
        return $field->name;
      }
    }
  }

  private function load($tableName)
  {
    $stmt = Connection::instance()->prepare('DESCRIBE ' .  $tableName);
    $stmt->execute();

    foreach ($stmt as $row) {
      $this->fields[] = new DbField($row);
    }
  }
}

class DbField
{
  function __construct($attributes)
  {
    $this->name = $attributes['Field'];
    $this->type = $attributes['Type'];
    $this->nullable = $attributes['Null'] == 'YES';
    $this->primaryKey = $attributes['Key'] == 'PRI';
    $this->uniqueKey = $attributes['Key'] == 'UNI';
  }
}
