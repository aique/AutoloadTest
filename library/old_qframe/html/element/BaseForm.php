<?php

/**
 * Formulario base del que heredarán todos los formularios utilizados
 * en la aplicación.
 * 
 * Contiene los atributos y el comportamiento común a todos ellos.
 * 
 * @package qframe
 * 
 * @subpackage html
 * 
 * @author qinteractiva
 *
 */
abstract class Library_Qframe_Html_Element_BaseForm extends Library_Qframe_Html_Element_FormElement
{
	protected $elements;
	protected $actions;
	protected $legend;
	
	protected $validator;
	
	const DEFAULT_ACTION = "#";
	const DEFAULT_METHOD = "POST";
	const DEFAULT_ENCTYPE = "application/x-www-form-urlencoded";
	
	public function __construct(array $attributes = array("action" => self::DEFAULT_ACTION,
														  "method" => self::DEFAULT_METHOD,
														  "enctype" => self::DEFAULT_ENCTYPE),
								array $validations = array(),
								$template = null)
	{
		$this->elements = array();
		$this->actions = array();
		$this->legend = null;
		$this->error = null;
		
		parent::__construct(Library_Qframe_Html_Const_FormElementConst::FORM, $attributes, $validations, $template, new Library_Qframe_Html_Printer_FormPrinter());

		$this->printer->setElement($this);
		
		$this->printer->setTemplate(Library_Qframe_Html_Printer_PrinterClient::getDefaultTemplate($this));
		
		$this->validator = new Library_Qframe_Html_Validation_FormElementValidator($this);
		
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
	 * Añade un nuevo elemento al formulario.
	 * 
	 * @param Library_Qframe_Html_Element_FormElement $element
	 */
	public function addElement(Library_Qframe_Html_Element_FormElement $element)
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
	
	/**
	 * Añade una nueva acción o operación al formulario.
	 * 
	 * @param Library_Qframe_Html_Element_Input $action
	 */
	public function addAction(Library_Qframe_Html_Element_Input $action)
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
	
	public abstract function init();
	
	/**
	 * Devuelve uno de los elementos que componen el formulario cuyo
	 * atributo name coincide con el valor recibido como parámetro.
	 * 
	 * @param string $nameValue
	 * 
	 * 		Valor del atributo name del elemento que se va a obtener.
	 * 
	 * @return Library_Qframe_Html_Form_FormElement
	 * 
	 * 		Objeto de tipo Library_Qframe_Html_Form_FormElement para el caso en
	 * 		el que el valor del atributo name de alguno	de los elementos
	 * 		del formulario coincida con el recibido como parámetro.
	 * 
	 * 		Devolverá null en caso contrario.
	 */
	public function getElementByNameAttribute($nameValue)
	{
		foreach($this->elements as $element)
		{
			if($element->getAttribute('name') == $nameValue)
			{
				return $element;
			}
		}
		
		return null;
	}
	
	/**
	 * Comprueba que los valores establecidos en cada uno de
	 * los campos del formulario son correctos.
	 * 
	 * @return boolean
	 * 
	 * 		Devuelve true en caso de que los campos del formulario
	 * 		sean correctos y false en caso contrario.
	 */
	public function isValid()
	{
		foreach($this->elements as $element)
		{
			if(!$this->validator->validateElement($element))
			{
				$this->setError(Library_Qframe_I18n_I18n::getText('screen_common_error_validation'));
				
				return false;
			}
		}
		
		return true;
	}
	
	/**
	 * Establece los valores de los campos del formulario en función
	 * de los encontrados en el array que recibe como parámetro.
	 * 
	 * El array recibido será un array asociativo. Este método
	 * comprobará sus claves y si alguna coincide con el valor del
	 * atributo name de alguno de los elementos del formulario,
	 * establecerá su valor al asociado a la mencionada clave dentro
	 * del array.
	 * 
	 * @param array $params
	 */
	public function setParams(array $params)
	{
		foreach($params as $paramName => $paramValue)
		{
			foreach($this->elements as $element)
			{
				if($paramName == $element->getAttribute("name"))
				{
					$element->setValue($paramValue);
				}	
			}
		}
	}
	
	public function __toString()
	{
		return $this->printer->standardPrint();
	}
	
}