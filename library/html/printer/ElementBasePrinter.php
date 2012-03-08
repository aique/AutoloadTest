<?php

abstract class Library_Html_Printer_ElementBasePrinter
{
	protected $element;
	
	public function __construct(Library_Html_BaseElement $element = null)
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