<?php

class Library_Html_Form_Printer_DefaultOptionPrinter extends Library_Html_Printer_ElementBasePrinter
{
	public function printHTML()
	{
		$output = '<option';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			$output .= self::getAttributeValue($name, $value);
		}
		
		$output .= '>' . $this->element->getDisplay() . '</option>';
		
		return $output;
	}
}