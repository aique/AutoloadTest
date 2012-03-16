<?php

class Library_Html_Form_Printer_DefaultSelectPrinter extends Library_Html_Form_Printer_DefaultFormElementPrinter
{
	protected function printElement()
	{
		$output = '<select';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			$output .= self::printAttribute($name, $value);
		}
		
		$output .= '>';
		
		$output .= $this->printOptions($this->element->getOptions());
		
		$output .= '</select><br />';
		
		return $output;
	}
	
	private function printOptions($options)
	{
		$output = '';
		
		foreach($options as $option)
		{
			$output .= $option;
		}
		
		return $output;
	}
}