<?php
include($_SERVER['DOCUMENT_ROOT'] . '/shared/dbFunctions.php');

class DatabaseContext {
  private $servidor = "localhost";
  private $usuario = "id18277836_mplp88";
  private $password = "M@rt!n2378$!";
  private $database = "id18277836_ponsite";
  private $conn;
  private $error;
  private $resultSet;
  private static $instances = [];

  protected function __construct() { }

  public static function getInstance(): DatabaseContext{
    $cls = static::class;
    if(!isset(self::$instances[$cls])) {
      self::$instances[$cls] = new static();
    }

    return self::$instances[$cls];
  }

  public function getConnection() {
    return $this->conn;
  }

  public function getError() {
    return $this->error;
  }

  public function getResultSet() {
    return $this->resultSet;
  }

  function connect() {
    // Create connection
    $this->conn = new mysqli($this->servidor, $this->usuario, $this->password, $this->database);

    // Check connection
    if ($this->conn->connect_error) {
      $this->error = "Fallo de conexión: " . $conn->connect_error;
    }
  }

  function close() {
    $this->conn->close();
  }

  function executeDbQuery($query) {
    $this->resultSet = $this->conn->query($query);
  }
}
?>