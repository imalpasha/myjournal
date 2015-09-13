<?php

class BaseModel
{
	public $db2 = null;

	function __construct()
	{
		require dirname(__FILE__).'/../../config.php';
		$this->db2 = new PDO('mysql:host=' . $DB_HOST. ';dbname=' . $DB_NAME. ';charset=utf8', $DB_USER, $DB_PASSWORD);

	}
}
