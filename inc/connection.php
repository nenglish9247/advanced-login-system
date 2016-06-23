<?php
class connection extends PDO {
  private static $instance;
  public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
    try {
      parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME.';charset=utf8', $DB_USER, $DB_PASS);
      $this->exec('SET CHARACTER SET utf8');
    } catch (PDOException $e) {
      die('Connection failed: ' . $e->getMessage());
    }
  }
}
?>
