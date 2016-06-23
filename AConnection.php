<?php
##
# @ CmsName: ACms
# @ Project: advanced-login-system
# @ Built with love <3 by Nicholas and other people whole have supported this project
/**
 * connection file
 */
/**
 * Class connection
 */
class connection extends PDO {
	/**
	 * @name: $instance (var)
	 * @purpose: Create a var to store the database connection
	 */
	private static $instance;
	/**
	 * @name: __construct (happens upon start of class)
	 * @param: $DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS
	 * @purpose: Create a secure database connection
	 */
	public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
		try {
			parent::__construct($DB_TYPE.':host='.$DB_HOST.';dbname='.$DB_NAME.';charset=utf8', $DB_USER, $DB_PASS);
			$this->exec('SET CHARACTER SET utf8');
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		} catch (PDOException $e) {
			die('Connection failed: ' . $e->getMessage());
		}
	}
	/**
	 * @name: getInstance
	 * @purpose: Get connection instance
	 */
	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new self(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
		}
		return self::$instance;
	}
	/**
	 * @name: select
	 * @param: $sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC
	 * @purpose: Select a record in a table
	 */
	public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
		$db = self::getInstance();
		$sth = $db->prepare($sql);
		foreach ($array as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		$sth->execute();
		$result = $sth->fetchAll($fetchMode);
		$sth->closeCursor();
		return $result;
	}
	/**
	 * @name: insert
	 * @param: $table, $data
	 * @purpose: Insert a record in a table
	 */
	public function insert($table, $data) {
		$db = self::getInstance();
		ksort($data);
		$fieldNames = implode('`, `', array_keys($data));
		$fieldValues = ':' . implode(', :', array_keys($data));
		$sth = $db->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
		foreach ($data as $key => $value) {
			$sth->bindValue(":$key", $value);
		}
		$sth->execute();
		$sth->closeCursor();
	}
	/**
	 * @name: update
	 * @param: $table, $data, $where, $whereBindArray = array()
	 * @purpose: Update a record in a table
	 */
	public function update($table, $data, $where, $whereBindArray = array()) {
		$db = self::getInstance();
		ksort($data);
		$fieldDetails = NULL;
        	foreach($data as $key => $value) {
            		$fieldDetails .= "`$key`=:$key,";
        	}
		$fieldDetails = rtrim($fieldDetails, ',');
		$sth = $db->prepare("UPDATE $table SET $fieldDetails WHERE $where");
		foreach ($data as $key => $value) {
            		$sth->bindValue(":$key", $value);
        	}
	        foreach ($whereBindArray as $key => $value) {
	            $sth->bindValue(":$key", $value);
	        }
		$sth->execute();
        	$sth->closeCursor();
	}
	/**
	 * @name: delete
	 * @param: $table, $where, $bind = array(), $limit = 1
	 * @purpose: Delete a record in a table
	 */
	public function delete($table, $where, $bind = array(), $limit = 1) {
        	$db = self::getInstance();
        	$sth = $db->prepare("DELETE FROM $table WHERE $where LIMIT $limit");
        	foreach ($bind as $key => $value) {
            		$sth->bindValue(":$key", $value);
        	}
        	$sth->execute();
        	$sth->closeCursor();
    	}
}
?>
