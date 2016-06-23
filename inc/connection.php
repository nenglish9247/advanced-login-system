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
  public static function getConnection() {
    if (self::$instance === null) {
      self::$instance = new self(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }
    return self::$instance;
  }
  public function select($sql, $array = array(), $fm = PDO::FETCH_ASSOC) {
    $db = self::getConnection();
    $select = $db->prepare($sql);
    foreach ($array as $key => $value) {
      $select->bindValue(":$key", $value);
    }
    $select->execute();
    $result = $select->fetchAll($fm);
    $select->closeCursor();
    return $result;
  }
  
}
?>
