<?php
require_once dirname(__FILE__) .'/../../include/PDOWrapper/NotORM.php';

class BaseModel
{
	
	public $db = null;

	function __construct()
	{
		require dirname(__FILE__).'/../../config.php';
        $pdo = new PDO('mysql:host=' . $DB_HOST. ';dbname=' . $DB_NAME. ';charset=utf8', $DB_USER, $DB_PASSWORD);
        $this->db = new NotORM($pdo);
		
		$this->db2 = new PDO('mysql:host=' . $DB_HOST. ';dbname=' . $DB_NAME. ';charset=utf8', $DB_USER, $DB_PASSWORD);
		
	}
}