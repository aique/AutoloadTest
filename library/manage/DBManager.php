<?php

/**
 * Clase encargada de comunicar la aplicación con la base de datos.
 * 
 * Está basada en la clase MySQLi, utilizando los métodos de la misma y ampliando
 * su funcionalidad si fuera necesario.
 * 
 * @author qinteractiva
 * 
 */
class Library_Manage_DBManager
{
	private $mysqli;
	
	private static $instance = null;
	
	private function __construct()
	{
		$this->mysqli = new mysqli(Library_Manage_ResourceManager::getConfig()->getVar('db.hostname'),
 								   Library_Manage_ResourceManager::getConfig()->getVar('db.username'),
 								   Library_Manage_ResourceManager::getConfig()->getVar('db.password'),
 								   Library_Manage_ResourceManager::getConfig()->getVar('db.database'));
	}
	
	public function __destruct()
	{
		$this->mysqli->close();
	}
	
	public static function getInstance()
	{
		if(self::$instance == null)
		{
			self::$instance = new Library_Manage_DBManager();
		}
		
		return self::$instance;
	}
	
	public function query($query)
	{
		Library_Manage_ResourceManager::getLogger()->logQuerySQL($query);
		
		$result = self::$instance->mysqli->query($query);
		
		return $result;
	}
	
}