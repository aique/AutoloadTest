<?php

abstract class Library_Html_BaseElement
{
	protected $name;
	protected $attributes;
	
	protected $printer;
	
	public function __construct($name, $attributes = array(), Library_Html_Printer_ElementBasePrinter $printer = null)
	{
		$this->name = $name;
		$this->attributes = $attributes;
		
		if($printer != null)
		{
			$this->printer = $printer;
		}
		else
		{
			$this->printer = new Library_Html_Printer_ElementBasePrinter($this);
		}
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
	
	public function addAttribute($attribute, $value)
	{
		$this->attributes[$attribute] = $value;
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
	
}