<?php

/**
 * Clase auxiliar con funcionalidad común de los controladores.
 * 
 * @package library
 * 
 * @subpackage controller
 * 
 * @author qinteractiva
 *
 */
class Library_Controller_ControllerHelper
{
	/**
	 * Realiza una redirección en cualquier punto de ejecución.
	 * 
	 * Crea una nueva petición, la almacena en sesión y la lanza sobre
	 * la aplicación mediante el método header().
	 * 
	 * @param Library_Request_Request $request
	 * 
	 * 		Objeto que contiene la información de la nueva petición que
	 * 		será tratada de inmediato por la aplicación.
	 */
	public function redirect(Library_Request_Request $request)
	{
		Library_Manage_SessionManager::setVar(Library_Consts_Resources::REQUEST, $request);
		
		header("Location: " . $request);
	}
}