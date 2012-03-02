<?php

class Library_App_Dispatcher
{
	public static function dispatchRequest()
	{
		$url = Library_Manage_ResourceManager::getURLData();
		
		$module = $url->getModule();
		$controller = $url->getController();
		
		if(empty($module))
		{
			$constructor = "Application_Controllers_" . $controller . "Controller";
		}
		else
		{
			$constructor = "Application_Modules_" . $module . "_Controllers_" . $controller . "Controller";
		}
		
		$controllerObj = new $constructor();
		
		$controllerObj->dispatch($url);
	}
}