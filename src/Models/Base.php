<?php

namespace Models;

use Db\Connection;
use Db\TableMetadata;
use PDOException;

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

class Base
{
  static protected $tableName;
  static protected $primaryKey;
  static protected $properties = [];
  protected $attributes = [];
  protected $initialAttributes = [];
  protected $validAttributes = [];
  protected $errors = [];
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

  static function tableMetadata()
  {
    return static::$tableMetadata ??= static::loadTableMetadata();
  }

  function __construct($attributes = [])
  {
    $this->attributes = count($attributes) == 0 ? $this->emptyAttributes() : $attributes;
    $this->initialAttributes = $this->attributes;
    $this->validAttributes = array_keys($this->attributes);
  }

  private function emptyAttributes()
  {
    return array_reduce(static::tableMetadata()->properties(), function ($attributes, $property) {
      $attributes[$property] = null;
      return $attributes;
    }, []);
  }

  public function isNewRecord()
  {
    return !count($this->attributes) || !(bool)$this->attributes[static::$primaryKey];
  }

  public function setAttributes($attributes)
  {
    foreach ($attributes as $attribute => $value) {
      if (in_array($attribute, $this->validAttributes)) {
        $this->{$attribute} = $value;
      }
    }
  }

  protected function update($changes)
  {
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
  }

  protected function insert($changes)
  {
    $columns = array_keys($changes);
    $values = array_map(function ($column) {
      return ':' . $column;
    }, $columns);


    $sql = 'INSERT INTO ' . static::$tableName . ' (' . implode(', ', $columns) . ') values (' . implode(', ', $values)  . ')';
    $stmt = Connection::instance()->prepare($sql);
    $stmt->execute($changes);

    $newId = Connection::instance()->lastInsertId();

    $this->{static::$primaryKey} = $newId;
  }

  function cleanAttributeName($value)
  {
    return preg_replace('/[^a-zA-Z0-9\_]/', '', $value);
  }

  function extractDuplicateEntryError($message)
  {
    if (str_contains($message, 'Integrity constraint violation') && str_contains($message, 'Duplicate entry')) {
      $matches = [];
      preg_match_all("/'.+?'/", $message, $matches);

      $values = $matches[0];
      $value = str_replace("'", '', $values[0]);
      $attribute = explode('.', $values[1])[1];

      $this->addError('UNIQUE_KEY', $attribute, $value);

      return true;
    }
  }

  function extractRequiredFieldWithoutDefaultValueError($message)
  {
    if (str_contains($message, "doesn't have a default value")) {
      $matches = [];
      preg_match("/'.+?'/", $message, $matches);

      $attribute = $matches[0];

      $this->addError('REQUIRED', $attribute);

      return true;
    }
  }

  function addError($errorType, $attribute, $value = null)
  {
    $attribute = $this->cleanAttributeName($attribute);

    $this->errors[$attribute] ??= [];
    $this->errors[$attribute][] = new ModelError($attribute, $errorType, $value);
  }

  function errors()
  {
    $errors = [];

    foreach ($this->errors as $attribute => $attributeErrors) {
      foreach ($attributeErrors as $error) {
        $errors[] = $error;
      }
    }

    return $errors;
  }

  public function save()
  {
    $changes = [];

    foreach (static::$properties as $property) {
      if ($this->attributes[$property] != $this->initialAttributes[$property]) {
        $changes[$property] = $this->attributes[$property];
      }
    }

    try {
      if ($this->isNewRecord()) {
        $this->insert($changes);
      } else {
        $this->update($changes);
      }
    } catch (PDOException $e) {
      $this->extractDuplicateEntryError($e->getMessage());
      $this->extractRequiredFieldWithoutDefaultValueError($e->getMessage());

      return false;
    }

    $this->initialAttributes = $this->attributes;

    return true;
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

    return new static($record);
  }
}

class UndefinedPropertyException extends \Exception
{
}

class RecordNotFound extends \Exception
{
}
