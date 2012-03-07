<?php

class Library_App_Dispatcher
{
	public static function dispatchRequest(Library_Request_Request $request)
	{
		$controller = self::getController($request);
		
		$controller->dispatch();
	}
	
	private static function getController(Library_Request_Request $request)
	{
		$module = $request->getModule();
		
		$controller = $request->getController();
		
		if(empty($module))
		{
			$constructor = "Application_Controllers_" . $controller . "Controller";
		}
		else
		{
			$constructor = "Application_Modules_" . $module . "_Controllers_" . $controller . "Controller";
		}
		
		return new $constructor($request);
	}
	
}