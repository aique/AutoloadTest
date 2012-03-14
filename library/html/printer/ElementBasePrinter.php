<?php

abstract class Library_Html_Printer_ElementBasePrinter extends Library_Printer_BasePrinter
{
	protected function printAttribute($name, $value)
	{
		if($name != 'label' && $name != 'display' && !empty($value))
		{
			return ' '.$name.'="'.$value.'"';
		}
		else
		{
			return '';
		}
	}
	
}