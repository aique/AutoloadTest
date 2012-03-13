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
	
	private $printer;
	
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
		
		$this->printer = new Library_Request_Printer($this);
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
	 * 
	 * 		Nombre del atributo que se almacenará en el array de parámetros.
	 * 
	 * @param string $value
	 * 
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
	 * Devuelve el valor de un parámetro almacenado en el array de la clase
	 * destinado a tal efecto a partir de su nombre.
	 * 
	 * @param string $name
	 * 
	 * 		Nombre del parámetro del que se quiere obtener el valor.
	 * 
	 * @return
	 * 
	 * 		Cadena de texto con el valor solicitado o null en caso de no
	 * 		encontrar coincidencias.
	 */
	public function getParam($name)
	{
		if(!empty($name) && isset($this->params[$name]))
		{
			return $this->params[$name];
		}
		else
		{
			return null;
		}
	}
	
	/**
	 * Imprime la petición en el mismo formato en el que el objeto
	 * ACL es capaz de interpretar los recursos sobre los que validará
	 * los permisos de acceso.
	 * 
	 * @return
	 * 
	 * 		Cadena de texto que representa la petición como un recurso.
	 */
	public function getResource()
	{
		return $this->printer->resourcePrint();
	}
	
	public function __toString()
	{
		return $this->printer->standardPrint();
	}
	
}