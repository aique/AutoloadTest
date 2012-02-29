<?php

/**
 * Clase que realiza las tareas necesarias de inicialización si fuera necesario.
 */
class Library_Loader_AppLoader
{
	/**
	 * Inicializa los objetos imprescindibles para el correcto funcionamiento de la
	 * aplicación.
	 * 
	 * Comprueba si el entorno en el que se está ejecutando es de tipo 'testing'. De
	 * ser así, no inicializa la clase que gestiona la URL de cada petición. Esto se
	 * hace para impedir que se muestren alertas en las pruebas unitarias, ya que el
	 * manejo de URLs no existe.
	 */
	public static function load()
	{
		Library_Manage_AppConfigManager::loadConfig();
		Library_Manage_I18nManager::loadI18nData();
		
		if(Library_Manage_AppConfigManager::getCurrentEnvironment() != Application_Consts_EnvironmentConst::TESTING_ENV)
		{
			Library_Manage_URLManager::loadURLData();
		}
	}
	
	public static function dispatchRequest()
	{
		$view = array();
		
		$module = Library_Manage_URLManager::getURLData()->getModule();
		$controller = Library_Manage_URLManager::getURLData()->getController();
		$action = Library_Manage_URLManager::getURLData()->getAction();
		
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