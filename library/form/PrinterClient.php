<?php

class Library_Form_PrinterClient
{
	public static function printHTML(Library_Form_FormElement $element)
	{
		$printer = $element->getPrinter(); 
		
		if(!$printer)
		{
			$printer = self::getPrinter($element);
		}
		
		return $printer->printHTML($element);
	}
	
	protected static function getPrinter($element)
	{
		$printer = null;
		
		$elementName = $element->getName();
	
		switch($elementName)
		{
			case(Library_Form_FormElementConst::INPUT):
				$printer = new Library_Form_Printer_DefaultInputPrinter($element);
				break;
	
			default:
				throw new Exception("El elemento '.$elementName.' no se encuentra dentro de los soportados por el gestor de formularios.");
		}
		
		return $printer;
	}
	
}