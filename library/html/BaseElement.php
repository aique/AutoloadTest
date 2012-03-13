<?php

abstract class Library_Html_BaseElement
{
	protected $name;
	protected $attributes;
	
	protected $printer;
	
	public function __construct($name, $attributes = array())
	{
		$this->name = $name;
		$this->attributes = $attributes;
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
	
	public function getValue()
	{
		if(isset($this->attributes["value"]))
		{
			return $this->attributes["value"];
		}
		else
		{
			return "";
		}
	}
	
	public function setValue($value)
	{
		$this->attributes["value"] = $value;
	}
	
	public function getDisplay()
	{
		if(isset($this->attributes["display"]))
		{
			return $this->attributes["display"];
		}
		else
		{
			return "";
		}
	}
	
	public function setDisplay($display)
	{
		$this->attributes["display"] = $display;
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
	
	public function __toString()
	{
		return $this->printer->standardPrint();
	}
	
}