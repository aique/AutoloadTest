<?php

abstract class Library_Form_Printer_FormElementBasePrinter
{
	protected $element;
	
	public function __construct(Library_Form_FormElement $element = null)
	{
		$this->element = $element;
	}
	
	public abstract function printHTML();
	
	protected function getAttributeValue($name, $value)
	{
		if($value)
		{
			return ' '.$name.'="'.$value.'"';
		}
		else
		{
			return "";
		}
	}
	
}