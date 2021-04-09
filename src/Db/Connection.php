<?php

namespace Db;

class Connection
{
  static private $activeConnection = null;

  static public function instance()
  {
    if (!self::$activeConnection) {
      self::connect();
    }

    return self::$activeConnection;
  }

  static private function connect()
  {
    $servername = $_ENV['DB_SERVERNAME'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $dbname = $_ENV['DB_NAME'];
    $dbport = $_ENV['DB_PORT'];

    try {
      $conn = new \PDO("mysql:host=$servername;dbname=$dbname;port=$dbport", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      self::$activeConnection = $conn;
    } catch (\PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  }
}
