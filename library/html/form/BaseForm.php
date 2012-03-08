<?php

abstract class Library_Html_Form_BaseForm extends Library_Html_BaseElement
{
	private $elements;
	
	private $error;
	
	const DEFAULT_ACTION = "#";
	const DEFAULT_METHOD = "POST";
	const DEFAULT_ENCTYPE = "application/x-www-form-urlencoded";
	
	public function __construct(array $attributes = array("action" => self::DEFAULT_ACTION,
														  "method" => self::DEFAULT_METHOD,
														  "enctype" => self::DEFAULT_ENCTYPE))
	{
		parent::__construct(Library_Html_Form_FormElementConst::FORM,
							$attributes,
							new Library_Html_Form_Printer_DefaultFormPrinter($this));
		
		$this->elements = array();
		
		$this->error = null;
		
		$this->init();
	}
	
	/**
	 * Devuelve el valor del atributo action.
	 *
	 * @return string
	 */
	public function getAction()
	{
	    return $this->attributes["action"];
	}
	 
	/**
	 * Establece el valor del atributo action.
	 *
	 * @param string $action
	 */
	public function setAction($action)
	{
	    $this->attributes["action"] = $action;
	}
	
	/**
	 * Devuelve el valor del atributo method.
	 *
	 * @return string
	 */
	public function getMethod()
	{
	    return $this->attributes["method"];
	}
	 
	/**
	 * Establece el valor del atributo method.
	 *
	 * @param string $method
	 */
	public function setMethod($method)
	{
	    $this->attributes["method"] = $method;
	}
	
	/**
	 * Devuelve el valor del atributo enctype.
	 *
	 * @return string
	 */
	public function getEnctype()
	{
	    return $this->attributes["enctype"];
	}
	 
	/**
	 * Establece el valor del atributo enctype.
	 *
	 * @param string $enctype
	 */
	public function setEnctype($enctype)
	{
	    $this->attributes["enctype"] = $enctype;
	}
	
	/**
	 * Devuelve el valor del atributo elements.
	 *
	 * @return array
	 */
	public function getElements()
	{
	    return $this->elements;
	}
	 
	/**
	 * Establece el valor del atributo elements.
	 *
	 * @param array $elements
	 */
	public function setElements($elements)
	{
	    $this->elements = $elements;
	}
	
	/**
	 * Devuelve el valor del atributo error.
	 *
	 * @return string
	 */
	public function getError()
	{
	    return $this->error;
	}
	 
	/**
	 * Establece el valor del atributo error.
	 *
	 * @param string $error
	 */
	public function setError($error)
	{
		$this->error = $error;
	}
	
	public abstract function init();
	
	public function addElement(Library_Html_Form_FormElement $element)
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
				if($element->getName() == Library_Html_Form_FormElementConst::INPUT)
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
		return $this->printer->printHTML();
	}
	
}