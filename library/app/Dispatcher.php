<?php

class Library_App_Dispatcher
{
	public static function dispatchRequest($url)
	{
		$controller = self::getController($url);
		$controller->dispatch();
	}
	
	private static function getController($url)
	{
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
		
		return new $constructor($url);
	}
	
}