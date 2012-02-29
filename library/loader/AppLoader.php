<?php

/**
 * Clase que realiza las tareas necesarias de inicialización si fuera necesario.
 */
class Library_Loader_AppLoader
{
	/**
	 * Inicializa los objetos imprescindibles para el correcto funcionamiento de la
	 * aplicación.
	 */
	public static function load()
	{
		
	}
	
	public static function dispatchRequest()
	{
		$view = array();
		
		$url = Library_Manage_ResourceManager::getURLData();
		
		$module = $url->getModule();
		$controller = $url->getController();
		$action = $url->getAction();
		
		if(empty($module))
		{
			$constructor = "Application_Controllers_" . $controller . "Controller";
		}
		else
		{
			$constructor = "Application_Modules_" . $module . "_Controllers_" . $controller . "Controller";
		}
		
		$controllerObj = new $constructor();
		
		$method = $action . "Action";
		
		if(!method_exists($controllerObj, $method))
		{
			throw new Exception('No se ha encontrado el método ' . $method . ' dentro del controlador ' . $constructor . '.');
		}
		
		$view = $controllerObj->$method($view);
		
		if(empty($module))
		{
			$viewPath = PROJECT_PATH . "/application/views/scripts/" . $controller . "/" . $action . ".php";
		}
		else
		{
			$viewPath = PROJECT_PATH . "/application/modules/" . $module . "/views/scripts/" . $controller . "/" . $action . ".php";
		}
		
		$content = Library_File_FileUtil::getFileContent($viewPath, $view);
		
		include PROJECT_PATH . "/application/layouts/scripts/layout.php";
	}
}