<?php

/**
 * Clase que carga de forma dinámica el resto de clases utilizadas por la aplicación
 * a partir de la ruta descrita en el nombre de las mismas.
 */
class Library_App_Autoloader
{
	private static $instance = null;
	
	private $path;
	
	private function __construct()
	{
		$this->path = PROJECT_PATH;
	}
	
	public static function getInstance()
	{
		if(self::$instance == null)
		{
			self::$instance = new Library_App_Autoloader();
		}
		
		return self::$instance;
	}
	
	public function register()
	{
		spl_autoload_register(array( $this, "autoload"));
	}
	
	private function autoload($className)
	{
		$path = str_replace("_", "/", $className);
		
		require_once PROJECT_PATH . "/" . $path . ".php";
	}
	
}