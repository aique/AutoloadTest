<?php

/**
 * Clase que imprime por pantalla una petición en sus distintos formatos.
 * 
 * @author qinteractiva
 *
 */
class Library_Request_Printer extends Library_Printer_BasePrinter
{
	public function __construct(Library_Request_Request $request)
	{
		parent::__construct($request);
	}
	
	/**
	 * Imprime la petición en el formato estándar.
	 * 
	 * Es llamado desde el método __toString de la petición y su
	 * formato de salida es igual a como se debe introducir la
	 * petición en la barra de direcciones del navegador:
	 * 
	 * - http://[nombreApp]/[modulo]/[controlador]/[action]/[param1]/[val1]/[param2]/[val2]/...
	 * 
	 * @return
	 * 
	 * 		Cadena de texto con la salida estándar de la petición.
	 */
	public function standardPrint()
	{
		return $this->resourcePrint() . $this->getParamsAsString();
	}
	
	/**
	 * Imprime la petición en el formato de recurso.
	 * 
	 * Este formato es el manejado por el objeto ACL para
	 * gestionar los permisos de acceso y su formato de salida es
	 * el siguiente:
	 * 
	 * - http://[nombreApp]/[modulo]/[controlador]/[action]
	 * 
	 * @return
	 * 
	 * 	Cadena de texto con la salida en formato recurso de la petición.
	 */
	public function resourcePrint()
	{
		$output = "http://" . Library_Manage_ResourceManager::getConfig()->getVar("app.name");
		
		$module = $this->getModuleAsString();
		$controller = $this->getControllerAsString();
		$action = $this->getActionAsString();
		
		if(!empty($module) || !empty($controller) || !empty($action))
		{
			$output .= $module . $controller . $action;
		}
		
		return $output;
	}
	
	private function getModuleAsString()
	{
		$output = "";
	
		if($this->element->getModule() != Library_Request_Request::MODULE_DEFAULT_VALUE)
		{
			$output = "/" . $this->element->getModule();
		}
	
		return $output;
	}
	
	private function getControllerAsString()
	{
		$output = "";
	
		if($this->element->getController() != Library_Request_Request::CONTROLLER_DEFAULT_VALUE)
		{
			$output = "/" . $this->element->getController();
		}
	
		return $output;
	}
	
	private function getActionAsString()
	{
		$output = "";
	
		if($this->element->getAction() != Library_Request_Request::ACTION_DEFAULT_VALUE)
		{
			if($this->element->getController() != Library_Request_Request::CONTROLLER_DEFAULT_VALUE)
			{
				$output = "/" . $this->element->getAction();
			}
			else
			{
				$output = $this->element->getAction();
			}
		}
	
		return $output;
	}
	
	private function getParamsAsString()
	{
		$output = "";
	
		foreach($this->element->getParams() as $paramName => $paramValue)
		{
			$output .= "/" . $paramName . "/" . $paramValue;
		}
	
		return $output;
	}
	
}