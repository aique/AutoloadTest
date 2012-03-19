<?php

abstract class Library_Html_Element_FormElement extends Library_Html_Element_BaseElement
{
	protected $validations;
	
	protected $error;
	
	public function __construct($name,
								array $attributes = array(),
								array $validations = array(),
								$template = null,
								Library_Html_Printer_ElementBasePrinter $printer = null)
	{
		$this->validations = $validations;
		
		parent::__construct($name, $attributes, $printer);
		
		$this->printer->setElement($this);
		
		if($template == null)
		{
			$template = Library_Html_Printer_PrinterClient::getDefaultTemplate($this);
		}
		
		$this->printer->setTemplate($template);
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
}