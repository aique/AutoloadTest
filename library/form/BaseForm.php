<?php

abstract class Library_Form_BaseForm
{
	private $action;
	private $method;
	private $enctype;
	
	private $elements;
	
	const DEFAULT_ACTION = "#";
	const DEFAULT_METHOD = "POST";
	const DEFAULT_ENCTYPE = "application/x-www-form-urlencoded";
	
	public function __construct($action = self::DEFAULT_ACTION, $method = self::DEFAULT_METHOD, $enctype = self::DEFAULT_ENCTYPE)
	{
		$this->action = $action;
		$this->method = $method;
		$this->enctype = $enctype;
		
		$this->init();
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
	    $this->action = $action;
	}
	
	/**
	 * Devuelve el valor del atributo method.
	 *
	 * @return string
	 */
	public function getMethod()
	{
	    return $this->method;
	}
	 
	/**
	 * Establece el valor del atributo method.
	 *
	 * @param string $method
	 */
	public function setMethod($method)
	{
	    $this->method = $method;
	}
	
	/**
	 * Devuelve el valor del atributo enctype.
	 *
	 * @return string
	 */
	public function getEnctype()
	{
	    return $this->enctype;
	}
	 
	/**
	 * Establece el valor del atributo enctype.
	 *
	 * @param string $enctype
	 */
	public function setEnctype($enctype)
	{
	    $this->enctype = $enctype;
	}
	
	public abstract function init();
	
	public function addElement(Library_Form_FormElement $element)
	{
		$this->elements[] = $element;
	}
	
	public function isValid()
	{
		foreach($this->elements as $element)
		{
			if(!$element->isValid())
			{
				return false;
			}
		}
		
		return true;
	}
	
	public function setParams(array $params)
	{
		foreach($params as $paramName => $paramValue)
		{
			foreach($this->elements as $element)
			{
				if($element->getName() == Library_Form_FormElementConst::INPUT)
				{
					if($paramName == $element->getAttributeByName("name"))
					{
						$element->setValue($paramValue);
					}
				}	
			}
		}
	}
	
	public function __toString()
	{
		$action = $this->action;
		
		if($action == self::DEFAULT_ACTION)
		{
			$action = Library_Manage_ResourceManager::getURLData();
		}
		
		$output = '<form action="'.$action.'" method="'.$this->method.'" enctype="'.$this->enctype.'">';
		
		foreach($this->elements as $element)
		{
			$output .= $element;
		}
		
		$output .= '</form>';
		
		return $output;
	}
	
}