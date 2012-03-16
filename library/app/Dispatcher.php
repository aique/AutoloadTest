<?php

/**
 * Se encarga de delegar en el controlador adecuado una petición realizada
 * sobre la aplicación.
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
class Library_App_Dispatcher
{
	/**
	 * Crea una instancia del controlador que ha de gestionar la petición
	 * realizada y llama a su método dispatch(), el cual será el verdadero
	 * encargado de atender la petición.
	 * 
	 * @param Library_Request_Request $request
	 * 
	 * 		Objeto que contiene entre sus atributos la información de la
	 * 		petición solicitada.
	 */
	public static function dispatchRequest(Library_Request_Request $request)
	{
		$controller = self::getController($request);
		
		if($controller)
		{
			$controller->dispatch();
		}
		else
		{
			Library_App_Dispatcher::dispatchRequest(new Library_Request_Request("", "error", "pageNotFound"));
		}
	}
	
	private static function getController(Library_Request_Request $request)
	{
		$module = $request->getModule();
		
		$controller = ucwords($request->getController());
		
		if(Library_App_Helper::isController($controller))
		{
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
		else
		{
			return null;
		}
	}
	
}