<?php

namespace Models;

use Db\Connection;
use Db\TableMetadata;

class Base
{
  static protected $tableName;
  static protected $primaryKey;
  static protected $properties = [];
  protected $attributes = [];
  protected $initialAttributes = [];
  static protected $tableMetadata;

  static protected function loadTableMetadata()
  {
    if (!static::$tableMetadata) {
      static::$tableMetadata = new TableMetadata(static::$tableName);
      static::$primaryKey = static::$tableMetadata->primaryKey();
      static::$properties = static::$tableMetadata->properties();
    }

    return static::$tableMetadata;
  }

  function __construct($attributes = [])
  {
    $this->attributes = $attributes;
    $this->initialAttributes = $attributes;
    static::loadTableMetadata();
  }

  public function isNewRecord()
  {
    return !count($this->attributes) || !(bool)$this->attributes[static::$primaryKey];
  }

  public function save()
  {
    $changes = [];

    foreach (static::$properties as $property) {
      if ($this->attributes[$property] != $this->initialAttributes[$property]) {
        $changes[$property] = $this->attributes[$property];
      }
    }

    if (count($changes)) {
      $tableName = static::$tableName;
      $primaryKey = static::$primaryKey;
      $conditions = [];

      $sql = "UPDATE $tableName SET ";

      foreach ($changes as $property => $_) {
        $conditions[] = "$property = :$property";
      }

      $sql .= implode(', ', $conditions);
      $sql .= " WHERE $primaryKey = {$this->{$primaryKey}}";

      $stmt = Connection::instance()->prepare($sql);
      $stmt->execute($changes);
    }

    $this->initialAttributes = $this->attributes;
  }


  private function handleUndefinedProperty($property)
  {
    $className = get_class($this);
    $message = "Undefined property $property in $className";

    throw new UndefinedPropertyException($message, 5);
  }

  public function __get($property)
  {
    if (in_array($property, static::$properties)) {
      return $this->attributes[$property];
    }

    $this->handleUndefinedProperty($property);
  }

  public function __set($property, $value)
  {
    if (in_array($property, static::$properties)) {
      $this->attributes[$property] = $value;
    } else {
      $this->handleUndefinedProperty($property);
    }
  }

  static function where($conditions = [], $params = [], $order = null, $direction = 'ASC', $page = 1, $limit = 100)
  {
    static::loadTableMetadata();
    $pdo = Connection::instance();

    $sqlConditions = implode(" AND ", $conditions);

    if (count($conditions)) {
      $sqlConditions = '  WHERE ' . $sqlConditions;
    }

    if (!$order) {
      $order = static::$primaryKey;
    }

    $clause = 'SELECT * from ' . static::$tableName . " $sqlConditions ORDER BY $order $direction LIMIT $limit";

    $stmt = $pdo->prepare($clause);
    $stmt->execute($params);

    $results = [];

    foreach ($stmt as $row) {
      $results[] = new User($row);
    }

    return $results;
  }

  static function find($id)
  {
    static::loadTableMetadata();
    $tableName = static::$tableName;
    $primaryKey = static::$primaryKey;
    $pdo = Connection::instance();

    $stmt = $pdo->prepare("SELECT * from {$tableName} where $primaryKey=:id");
    $stmt->execute([$primaryKey => $id]);
    $record = $stmt->fetch();

    if (!$record) {
      throw new RecordNotFound("Couldn't find record with $primaryKey=$id");
    }

    return new User($record);
  }
}

class UndefinedPropertyException extends \Exception
{
}

class RecordNotFound extends \Exception
{
}
