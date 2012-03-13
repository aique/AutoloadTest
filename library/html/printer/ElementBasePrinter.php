<?php

abstract class Library_Html_Printer_ElementBasePrinter extends Library_Printer_BasePrinter
{
	public function __construct(Library_Html_BaseElement $element = null)
	{
		parent::__construct($element);
	}
	
	protected function printAttribute($name, $value)
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