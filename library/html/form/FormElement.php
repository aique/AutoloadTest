<?php

abstract class Library_Html_Form_FormElement extends Library_Html_BaseElement
{
	protected $validations;
	
	public function __construct($name, array $attributes = array(), array $validations = array(), Library_Html_Printer_ElementBasePrinter $printer = null)
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
	
	public abstract function isValid();
	
	public function __toString()
	{
		return Library_Html_Form_PrinterClient::printHTML($this);
	}
	
}