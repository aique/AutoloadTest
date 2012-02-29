<?php

class Library_URL_URLData
{
	private $module;
	private $controller;
	private $action;
	private $params;
	
	public function __construct()
	{
		$this->module = "";
		$this->controller = "index";
		$this->action = "index";
		$this->params = array();
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
		if(!empty($params))
		{
	    	$this->params = $params;
		}
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
	
	public function __toString()
	{
		return '/' . $this->module . '/' . $this->controller . '/' . $this->action;
	}
	
}