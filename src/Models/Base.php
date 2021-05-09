<?php

namespace Models;

use Db\Connection;
use Db\TableMetadata;
use PDOException;

class Base
{
  const FIELD_TYPES = [];
  const RELATED_MODELS = [];

  use FieldTypeSupport;

  static protected $tableName;
  protected $attributes = [];
  protected $dirtyAttributes = [];
  protected $initialAttributes = [];
  protected $validAttributes = [];
  protected $errors = [];
  static protected $tablesMetadata = [];

  static protected function loadTableMetadata()
  {
    return new TableMetadata(static::$tableName);
  }

  static function tableMetadata()
  {
    return static::$tablesMetadata[static::$tableName] ??= static::loadTableMetadata();
  }

  function __construct($attributes = [])
  {
    $this->dirtyAttributes = $attributes;
    $this->validAttributes = array_keys($this->emptyAttributes());
    $this->attributes = [];
    $this->setAttributes(count($attributes) == 0 ? $this->emptyAttributes() : $attributes);
    $this->initialAttributes = $this->attributes;
  }

  function attributes()
  {
    return $this->attributes;
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
    return !count($this->attributes) || !(bool)$this->attributes[static::tableMetadata()->primaryKey()];
  }

  public function setAttributes($attributes)
  {
    foreach ($attributes as $attribute => $value) {
      if (in_array($attribute, $this->validAttributes)) {
        $this->{$attribute} = $this->readAttribute($attribute, $value);
      }
    }
  }

  protected function update($changes)
  {
    if (count($changes)) {
      $tableName = static::$tableName;
      $primaryKey = static::tableMetadata()->primaryKey();
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

    $this->{static::tableMetadata()->primaryKey()} = $newId;
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

  function extractIntegrityConstraintDefaultValueError($message)
  {
    if (str_contains($message, "cannot be null")) {
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

  public function destroy()
  {
    $sql = 'DELETE FROM ' . static::$tableName . ' WHERE id = ' . $this->id;

    $stmt = Connection::instance()->prepare($sql);
    $stmt->execute();
  }

  public function save()
  {
    $changes = [];

    foreach (static::tableMetadata()->properties() as $property) {
      if ($this->attributes[$property] != $this->initialAttributes[$property]) {
        $changes[$property] = $this->writeAttribute($property, $this->attributes[$property]);
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
      $this->extractIntegrityConstraintDefaultValueError($e->getMessage());

      var_dump($e);

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

  static $eagerLoadedRelations = [];

  public function relations($name)
  {
    return static::$eagerLoadedRelations[$name] ??= static::loadModelData(ucfirst($name));
  }

  static function loadModelData($name)
  {
    $modelClass = "Models\\$name";

    $items = forward_static_call_array([$modelClass, 'where'], []);

    return array_reduce($items, function ($result, $item) {
      $result[$item->id] = $item;

      return $result;
    }, []);
  }

  public function __get($property)
  {
    $relation = null;
    $propertyFromRelation = null;

    if (str_contains($property, '.')) {
      $relation = explode('.', $property)[0];
      $propertyFromRelation = explode('.', $property)[1];
    }

    if (in_array($property, static::tableMetadata()->properties())) {
      return $this->attributes[$property];
    }

    if (method_exists($this, '_' .  $property)) {
      return $this->{'_' . $property}();
    }

    if (!$relation) {
      $relation = $property;
    }

    if (in_array($relation, array_keys(static::RELATED_MODELS))) {
      $relatedProperty = static::RELATED_MODELS[$relation];

      $relatedRecord = $this->relations($relation)[$this->attributes[$relatedProperty]];

      if ($propertyFromRelation) {
        return $relatedRecord->{$propertyFromRelation};
      } else {
        return $relatedRecord;
      }
    }

    $this->handleUndefinedProperty($property);
  }

  public function __set($property, $value)
  {
    if (in_array($property, static::tableMetadata()->properties())) {
      $this->attributes[$property] = $value;
    } else {
      $this->handleUndefinedProperty($property);
    }
  }

  const SELECT_CLAUSE = 'SELECT * FROM ';

  static function where($conditions = [], $params = [], $order = null, $direction = 'ASC', $page = 1, $limit = 100)
  {
    $pdo = Connection::instance();

    $sqlConditions = implode(" AND ", $conditions);

    if (count($conditions)) {
      $sqlConditions = '  WHERE ' . $sqlConditions;
    }

    if (!$order) {
      $order = static::tableMetadata()->primaryKey();
    }

    $clause = static::SELECT_CLAUSE . static::$tableName . " $sqlConditions ORDER BY $order $direction LIMIT $limit";

    $stmt = $pdo->prepare($clause);
    $stmt->execute($params);

    $results = [];

    foreach ($stmt as $row) {
      $results[] = new static($row);
    }

    return $results;
  }

  static function find($id)
  {
    $tableName = static::$tableName;
    $primaryKey = static::tableMetadata()->primaryKey();
    $pdo = Connection::instance();
    $sql = "SELECT * from {$tableName} where $primaryKey=:id";

    $stmt = $pdo->prepare($sql);
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
