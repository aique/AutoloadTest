<?php

class Library_Html_Form_Printer_DefaultCheckboxPrinter extends Library_Html_Form_Printer_DefaultFormElementPrinter
{
	protected function printElement()
	{
		$output = '<label class="checkbox"><input';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			$output .= self::printAttribute($name, $value);
		}
		
		$output .= ' />'.$this->element->getDisplay().'</label>';
		
		return $output;
	}
}