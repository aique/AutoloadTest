<?php

abstract class Library_Html_Form_FormElement extends Library_Html_BaseElement
{
	protected $validations;
	
	public function __construct($name,
								array $attributes = array(),
								array $validations = array(),
								Library_Html_Printer_ElementBasePrinter $printer = null)
	{
		$this->validations = $validations;
		
		parent::__construct($name, $attributes, $printer);
	}
	
	/**
	 * Devuelve el valor del atributo validations.
	 *
	 * @return array
	 */
	public function getValidations()
	{
	    return $this->validations;
	}
	 
	/**
	 * Establece el valor del atributo validations.
	 *
	 * @param array $validations
	 */
	public function setValidations($validations)
	{
	    $this->validations = $validations;
	}
	
	/**
	 * Obtiene el valor del atributo name del elemento.
	 * 
	 * @return string
	 * 
	 * 		Devuelve una cadena de texto con el valor del atributo name
	 * 		del elemento o null en caso de que este atributo no se encuentre.
	 */
	public function getNameAttributeValue()
	{
		if(isset($this->attributes["name"]))
		{
			return $this->attributes["name"];
		}
		else
		{
			return null;
		}
	}
	
}