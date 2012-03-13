<?php

abstract class Library_Html_Form_BaseForm extends Library_Html_BaseElement
{
	private $elements;
	private $actions;
	private $legend;
	private $error;
	
	private $validator;
	
	const DEFAULT_ACTION = "#";
	const DEFAULT_METHOD = "POST";
	const DEFAULT_ENCTYPE = "application/x-www-form-urlencoded";
	
	public function __construct(array $attributes = array("action" => self::DEFAULT_ACTION,
														  "method" => self::DEFAULT_METHOD,
														  "enctype" => self::DEFAULT_ENCTYPE))
	{
		$this->elements = array();
		$this->actions = array();
		$this->legend = null;
		$this->error = null;
		
		parent::__construct(Library_Html_Form_FormElementConst::FORM,
							$attributes);
		
		$this->printer = new Library_Html_Form_Printer_DefaultFormPrinter($this);
		
		$this->validator = new Library_Html_Form_FormElementValidator($this);
		
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
	
	public function addElement(Library_Html_Form_FormElement $element)
	{
		$this->elements[] = $element;
	}
	
	/**
	 * Devuelve el valor del atributo actions.
	 *
	 * @return array
	 */
	public function getActions()
	{
	    return $this->actions;
	}
	 
	/**
	 * Establece el valor del atributo actions.
	 *
	 * @param array $actions
	 */
	public function setActions($actions)
	{
	    $this->actions = $actions;
	}
	
	public function addAction(Library_Html_Form_Element_Input $action)
	{
		$this->actions[] = $action;
	}
	
	/**
	 * Devuelve el valor del atributo legend.
	 *
	 * @return string
	 */
	public function getLegend()
	{
	    return $this->legend;
	}
	 
	/**
	 * Establece el valor del atributo legend.
	 *
	 * @param string $legend
	 */
	public function setLegend($legend)
	{
	    $this->legend = $legend;
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
	
	/**
	 * Devuelve uno de los elementos que componen el formulario cuyo
	 * atributo name coincide con el valor recibido como parámetro.
	 * 
	 * @param string $nameValue
	 * 
	 * 		Valor del atributo name del elemento que se va a obtener.
	 * 
	 * @return Library_Html_Form_FormElement
	 * 
	 * 		Devuelve un objeto de tipo Library_Html_Form_FormElement
	 * 		para el caso en el que el valor del atributo name de alguno
	 * 		de los elementos del formulario coincida con el recibido como
	 * 		parámetro.
	 * 
	 * 		Devolverá null en caso contrario.
	 */
	public function getElementByNameAttribute($nameValue)
	{
		foreach($this->elements as $element)
		{
			if($element->getNameAttributeValue() == $nameValue)
			{
				return $element;
			}
		}
		
		return null;
	}
	
	public function isValid()
	{
		foreach($this->elements as $element)
		{
			if(!$this->validator->validateElement($element))
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
// 				if($element->getName() == Library_Html_Form_FormElementConst::INPUT)
// 				{
					if($paramName == $element->getAttributeByName("name"))
					{
						$element->setValue($paramValue);
					}
// 				}	
			}
		}
	}
	
	public function __toString()
	{
		return $this->printer->standardPrint();
	}
	
}