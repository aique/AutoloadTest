<?php

/**
 * Realiza la carga automática de clases en función de la ruta
 * especificada a través del nombre de la misma.
 * 
 * Se instancia dentro del bootstrap como una de las primeras
 * acciones que se realiza dentro del proceso de atención de
 * una petición.
 * 
 * @package library
 * 
 * @subpackage app
 * 
 * @author qinteractiva
 *
 */
class Library_App_Autoloader
{
	private static $instance = null;
	
	private $path;
	
	private function __construct()
	{
		$this->path = PROJECT_PATH;
	}
	
	/**
	 * Crea una instancia de la clase.
	 */
	public static function getInstance()
	{
		if(self::$instance == null)
		{
			self::$instance = new Library_App_Autoloader();
		}
		
		return self::$instance;
	}
	
	/**
	 * Registra el método autoload() de esta misma clase como respuesta
	 * al método __autoload() de PHP.
	 */
	public function register()
	{
		spl_autoload_register(array( $this, "autoload"));
	}
	
	/**
	 * Cada vez que se instancia un nuevo objeto, esta función será
	 * llamada y se encargará de incluir el fichero donde se encuentra
	 * declarada la clase de manera dinámica a través de su nombre.
	 * 
	 * El método utilizado para incluir el fichero será require_once().
	 * 
	 * @param string $className
	 * 
	 * 		Nombre de la clase cuyo fichero en el que se encuentra
	 * 		definida se desea incluir.
	 */
	private function autoload($className)
	{
		$file = PROJECT_PATH . '/' . str_replace('_', '/', $className) . '.php';
		
		if(file_exists($file))
		{
			require_once $file;
		}
	}
	
}