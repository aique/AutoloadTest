<?php

/**
 * Clase encargada de comunicar la aplicación con la base de datos.
 * 
 * Hereda de la clase MySQLi, utilizando los métodos de la misma y
 * ampliando su funcionalidad si fuera necesario.
 * 
 * @package qframe
 * 
 * @subpackage manage
 * 
 * @author qinteractiva
 * 
 */
class Library_Qframe_Manage_DBManager extends mysqli
{
	private $server;
	private $dbName;
	private $user;
	private $pass;
	
	private static $instance;
	
	private function __construct()
	{
		$this->server = Library_Qframe_Manage_ResourceManager::getConfig()->getVar('db.hostname');
		$this->dbName = Library_Qframe_Manage_ResourceManager::getConfig()->getVar('db.database');
		$this->user = Library_Qframe_Manage_ResourceManager::getConfig()->getVar('db.username');
 		$this->pass = Library_Qframe_Manage_ResourceManager::getConfig()->getVar('db.password');
 		
		$this->connect();
	}
	
	public function __destruct()
	{
		parent::close();
	}
	
	/**
	 * Devuelve una instancia de la clase.
	 * 
	 * De esta manera se impide que exista más de una conexión
	 * abierta de manera simultánea para un mismo usuario. 
	 *
	 * @return Library_Qframe_Manage_DBManager
	 * 
	 */
	public static function getInstance()
	{
		if(self::$instance == null)
		{
			self::$instance = new Library_Qframe_Manage_DBManager();
		}
		
		return self::$instance;
	}
	
	/**
	 * Devuelve el valor del atributo server.
	 *
	 * @return string
	 */
	public function getServer()
	{
	    return $this->server;
	}
	 
	/**
	 * Establece el valor del atributo server.
	 *
	 * @param string $server
	 */
	public function setServer($server)
	{
	    $this->server = $server;
	}
	
	/**
	 * Devuelve el valor del atributo dbName.
	 *
	 * @return string
	 */
	public function getDbName()
	{
	    return $this->dbName;
	}
	 
	/**
	 * Establece el valor del atributo dbName.
	 *
	 * @param string $dbName
	 */
	public function setDbName($dbName)
	{
	    $this->dbName = $dbName;
	}
	
	/**
	 * Devuelve el valor del atributo user.
	 *
	 * @return string
	 */
	public function getUser()
	{
	    return $this->user;
	}
	 
	/**
	 * Establece el valor del atributo user.
	 *
	 * @param string $user
	 */
	public function setUser($user)
	{
	    $this->user = $user;
	}
	
	/**
	 * Devuelve el valor del atributo pass.
	 *
	 * @return string
	 */
	public function getPass()
	{
	    return $this->pass;
	}
	 
	/**
	 * Establece el valor del atributo pass.
	 *
	 * @param string $pass
	 */
	public function setPass($pass)
	{
	    $this->pass = $pass;
	}
	
	/**
	 * Ejecuta una sentencia SQL sobre la base de datos cuya conexión
	 * se ha establecido en el método connect().
	 * 
	 * @param string query
	 * 
	 * 		Cadena de texto con la consulta SQL que se ejecutará.
	 * 
	 * @return
	 * 
	 * 		Devuelve el resultado de la consulta realizada en el formato
	 * 		determinado por la clase MySQLi.
	 */
	public function query($query)
	{
		Library_Qframe_Manage_ResourceManager::getLogger()->logDBQuery($query);
	
		$result = parent::query($query);
		
		if(!$result)
		{
			Library_Qframe_Manage_ResourceManager::getLogger()->logDBQueryError($query);
			
			throw new Exception("La consulta SQL realizada sobre la base de datos ha provocado un error.");
		}
	
		return $result;
	}
	
	/**
	 * Establece una conexión con la base de datos en función de los
	 * parámetros a tal efecto que se han establecido en el fichero de
	 * configuración de la aplicación.
	 */
	public function connect()
	{
		Library_Qframe_Manage_ResourceManager::getLogger()->logDBConnection($this);
		
		parent::connect($this->server, $this->user, $this->pass, $this->dbName);
		
		if(mysqli_connect_errno())
		{
			Library_Qframe_Manage_ResourceManager::getLogger()->logDBConnectionError(mysqli_connect_error());

			throw new Exception("La configuración de la conexión con la base de datos ha provocado un error.");
		}
		else
		{				
			parent::set_charset("utf8");		
		}
	}
	
}