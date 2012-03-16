<?php

class Library_Html_Form_Printer_DefaultTextAreaPrinter extends Library_Html_Form_Printer_DefaultFormElementPrinter
{
	protected function printElement()
	{
		$output = '<textarea';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			$output .= self::printAttribute($name, $value);
		}
		
		$output .= '>'.$this->element->getDisplay().'</textarea>';
		
		return $output;
	}
}