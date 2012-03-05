<?php

/**
 * Clase que extiende el comportamiento de MySQLi, ampliandolo si fuera necesario.
 * 
 * Será la encargada de comunicarse con la base de datos a lo largo de toda la
 * aplicación.
 */
class Library_Manage_DBManager
{
	private static $dbManager = null;
	
	private $mysqli;
	
	private function __construct()
	{
		$this->mysqli = new mysqli(Library_Manage_ResourceManager::getAppConfig()->getVar('db.hostname'),
 								   Library_Manage_ResourceManager::getAppConfig()->getVar('db.username'),
 								   Library_Manage_ResourceManager::getAppConfig()->getVar('db.password'),
 								   Library_Manage_ResourceManager::getAppConfig()->getVar('db.database'));
	}
	
	public function __destruct()
	{
		$this->mysqli->close();
	}
	
	public static function getDbManager()
	{
		if(self::$dbManager == null)
		{
			self::$dbManager = new Library_Manage_DBManager();
		}
		
		return self::$dbManager;
	}
	
	public function query($query)
	{
		Library_Manage_ResourceManager::getLogger()->logQuerySQL($query);
		
		$result = self::$dbManager->mysqli->query($query);
		
		return $result;
	}
	
}