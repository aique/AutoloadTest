<?php

/**
 * Clase que representa una petición realizada sobre la aplicación.
 * 
 * Estas peticiones pueden tener su origen bien en la solicitud de un
 * usuario o bien en redirecciones internas a la misma.
 * 
 * @author qinteractiva
 *
 */
class Library_Request_Request
{
	private $module;
	private $controller;
	private $action;
	private $params;
	
	const MODULE_DEFAULT_VALUE = "";
	const CONTROLLER_DEFAULT_VALUE = "index";
	const ACTION_DEFAULT_VALUE = "index";
	
	public function __construct($module = self::MODULE_DEFAULT_VALUE,
								$controller = self::CONTROLLER_DEFAULT_VALUE,
								$action = self::ACTION_DEFAULT_VALUE,
								$params = array())
	{
		$this->module = $module;
		$this->controller = $controller;
		$this->action = $action;
		$this->params = $params;
	}
	
	/**
	 * Devuelve el valor del atributo module.
	 *
	 * @return string
	 */
	public function getModule()
	{
	    return $this->module;
	}
	 
	/**
	 * Establece el valor del atributo module.
	 *
	 * @param string $module
	 */
	public function setModule($module)
	{
	    $this->module = $module;
	}
	
	/**
	 * Devuelve el valor del atributo controller.
	 *
	 * @return string
	 */
	public function getController()
	{
		return $this->controller;
	}
	 
	/**
	 * Establece el valor del atributo controller.
	 *
	 * @param string $controller
	 */
	public function setController($controller)
	{
		if(!empty($controller))
		{
	    	$this->controller = $controller;
		}
	}
	
	/**
	 * Devuelve el valor del atributo action.
	 *
	 * @return string
	 */
	public function getAction()
	{
	    return $this->action;
	}
	 
	/**
	 * Establece el valor del atributo action.
	 *
	 * @param string $action
	 */
	public function setAction($action)
	{
		if(!empty($action))
		{
	    	$this->action = $action;
		}
	}
	
	/**
	 * Devuelve el valor del atributo params.
	 *
	 * @return array
	 */
	public function getParams()
	{
	    return $this->params;
	}
	 
	/**
	 * Establece el valor del atributo params.
	 *
	 * @param array $params
	 */
	public function setParams($params)
	{
		$this->params = $params;
	}
	
	/**
	 * Almacena un atributo en el array de parámetros.
	 * 
	 * @param string $name
	 * 		Nombre del atributo que se almacenará en el array de parámetros.
	 * 
	 * @param string $value
	 * 		Valor del atributo que se almacenará en el array de parámetros.
	 */
	public function setParam($name, $value)
	{
		if(!empty($name) && !empty($value))
		{
			$this->params[$name] = $value;
		}
	}
	
	/**
	 * Devuelve el valor de un parámetro almacenado en el array a tal efecto
	 * a partir de su nombre.
	 * 
	 * @param string $name
	 * 		Nombre del parámetro del que se quiere obtener el valor.
	 */
	public function getParam($name)
	{
		if(!empty($name) && isset($this->params[$name]))
		{
			return $this->params[$name];
		}
		else
		{
			return false;
		}
	}
	
	// TODO Valorar si sacarlo a una clase printer
	
	public function getResource()
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
	
	public function __toString()
	{
		return $this->getResource() . $this->getParamsAsString();
	}
	
	private function getModuleAsString()
	{
		$output = "";
		
		if($this->module != self::MODULE_DEFAULT_VALUE)
		{
			$output = "/" . $this->module;
		}
		
		return $output;
	}
	
	private function getControllerAsString()
	{
		$output = "";
		
		if($this->controller != self::CONTROLLER_DEFAULT_VALUE)
		{
			$output = "/" . $this->controller;
		}
		
		return $output;
	}
	
	private function getActionAsString()
	{
		$output = "";
		
		if($this->action != self::ACTION_DEFAULT_VALUE)
		{
			if($this->controller != self::CONTROLLER_DEFAULT_VALUE)
			{
				$output = "/" . $this->action;
			}
			else
			{
				$output = $this->action;
			}
		}
		
		return $output;
	}
	
	private function getParamsAsString()
	{
		$output = "";
		
		foreach($this->params as $paramName => $paramValue)
		{
			$output .= "/" . $paramName . "/" . $paramValue;
		}
		
		return $output;
	}
	
}