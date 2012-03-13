<?php

class Library_Html_Form_Printer_DefaultOptionPrinter extends Library_Html_Form_Printer_DefaultFormElementPrinter
{
	protected function printElement()
	{
		$output = '<option';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			$output .= self::printAttribute($name, $value);
		}
		
		$output .= '>' . $this->element->getDisplay() . '</option>';
		
		return $output;
	}
	
	public function printSelectedOption()
	{
		$output = '<option';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			$output .= self::printAttribute($name, $value);
		}
		
		$output .= 'selected="selected">' . $this->element->getDisplay() . '</option>';
		
		return $output;
	}
}