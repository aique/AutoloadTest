<?php

class Library_Html_Form_Printer_DefaultSelectPrinter extends Library_Html_Form_Printer_DefaultFormElementPrinter
{
	protected function printElement()
	{
		$output = '<select';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			if($name != "label")
			{
				$output .= self::printAttribute($name, $value);
			}
		}
		
		$output .= '>';
		
		foreach($this->element->getOptions() as $option)
		{
			$output .= $option;
		}
		
		$output .= '</select><br />';
		
		return $output;
	}
}