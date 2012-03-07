<?php

abstract class Library_Form_FormElement
{
	protected $name;
	protected $attributes;
	protected $validations;
	
	private $printer;
	
	public function __construct($name, array $attributes, array $validations = array(), Library_Form_Printer_FormElementBasePrinter $printer = null)
	{
		$this->name = $name;
		$this->attributes = $attributes;
		$this->validations = $validations;
		$this->printer = $printer;
	}
	
	/**
	 * Devuelve el valor del atributo name.
	 *
	 * @return string
	 */
	public function getName()
	{
	    return $this->name;
	}
	
	/**
	 * Establece el valor del atributo name.
	 *
	 * @param string $name
	 */
	public function setName($name)
	{
	    $this->name = $name;
	}
	
	/**
	 * Devuelve el valor del atributo attributes.
	 *
	 * @return array
	 */
	public function getAttributes()
	{
	    return $this->attributes;
	}
	
	/**
	 * Establece el valor del atributo attributes.
	 *
	 * @param array $attributes
	 */
	public function setAttributes($attributes)
	{
	    $this->attributes = $attributes;
	}
	
	public function getAttributeByName($name)
	{
		foreach($this->attributes as $attributeName => $attributeValue)
		{
			if($attributeName == $name)
			{
				return $attributeValue;
			}
		}
		
		return false;
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
	 * Devuelve el valor del atributo printer.
	 *
	 * @return Library_Form_Printer_BaseDefaultPrinter
	 */
	public function getPrinter()
	{
	    return $this->printer;
	}
	
	/**
	 * Establece el valor del atributo printer.
	 *
	 * @param Library_Form_Printer_DefaultInputPrinter $printer
	 */
	public function setPrinter($printer)
	{
	    $this->printer = $printer;
	}
	
	public abstract function isValid();
	
	public function __toString()
	{
		return Library_Form_PrinterClient::printHTML($this);
	}
	
}