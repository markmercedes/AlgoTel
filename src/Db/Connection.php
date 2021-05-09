<?php

namespace Db;

class Connection
{
  static private $activeConnection = null;

  static public function instance()
  {
    return self::$activeConnection ??= self::connect();
  }

  static private function connect()
  {
    $servername = $_ENV['DB_SERVERNAME'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $dbname = $_ENV['DB_NAME'];
    $dbport = $_ENV['DB_PORT'];

    try {
      $conn = new \PDO("mysql:host=$servername;dbname=$dbname;port=$dbport", $username, $password, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      // set the PDO error mode to exception
      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      return self::$activeConnection = $conn;
    } catch (\PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }

  static public function query($sql, $params = [])
  {
    $pdo = static::instance();

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $results = [];

    foreach ($stmt as $row) {
      $results[] = $row;
    }

    return $results;
  }
}
