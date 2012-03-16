<?php

class Library_Html_Form_Printer_DefaultRadioPrinter extends Library_Html_Form_Printer_DefaultFormElementPrinter
{
	protected function printElement()
	{
		$output = '<div class="radio"><input';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			$output .= self::printAttribute($name, $value);
		}
		
		$output .= ' /><label class="radio_label">'.$this->element->getDisplay().'</label></div>';
		
		return $output;
	}
}