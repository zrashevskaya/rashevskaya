<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 13.09.16
 * Time: 10:32
 */
class Database {
  /**
   *
   *
   *
   */
  private static $instance = NULL;
  /**
   *
   * @var string
   *
   */
  private $host = DB_HOST;
  /**
   *
   *
   *
   */
  private $user = DB_USER;
  /**
   *
   *
   *
   */
  private $pass = DB_PASS;
  /**
   *
   *
   *
   */
  private $dbname = DB_NAME;
  /**
   *
   *
   *
   */
  private $dbh;
  /**
   *
   *
   *
   */
  private $error;
  /**
   *
   *
   *
   */
  private $stmt;

  /**
   *
   *
   *
   */
  private function __construct() {
// Set DSN
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
// Set options
    $options = array(
      PDO::ATTR_PERSISTENT => TRUE,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } // Catch any errors
    catch (PDOException $e) {
      $this->error = $e->getMessage();
    }
  }

  /**
   *
   *
   *
   */
  public static function connect() {
    if (self::$instance == NULL) {
      self::$instance = new Database();
    }
    return self::$instance;
  }

  /**
   *
   *
   *
   */
  public function query($query) {
    $this->stmt = $this->dbh->prepare($query);
  }

  /**
   *
   *
   *
   */
  public function bind($param, $value, $type = NULL) {
    if (is_null($type)) {
      switch (TRUE) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  /**
   *
   *
   *
   */
  public function resultset() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   *
   *
   *
   */
  public function execute() {
    return $this->stmt->execute();
  }

  /**
   *
   *
   *
   */
  public function single() {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  /**
   *
   *
   *
   */
  public function rowCount() {
    return $this->stmt->rowCount();
  }

  /**
   *
   *
   *
   */
  public function lastInsertId() {
    return $this->dbh->lastInsertId();
  }

  /**
   *
   *
   *
   */
  public function beginTransaction() {
    return $this->dbh->beginTransaction();
  }

  /**
   *
   *
   *
   */
  public function endTransaction() {
    return $this->dbh->commit();
  }

  /**
   *
   *
   *
   */
  public function cancelTransaction() {
    return $this->dbh->rollBack();
  }

  /**
   *
   *
   *
   */
  public function debugDumpParams() {
    return $this->stmt->debugDumpParams();
  }
}

