<?php

class Library_Html_Form_Printer_DefaultSelectPrinter extends Library_Html_Printer_ElementBasePrinter
{
	public function printHTML()
	{
		$output = '<select';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			if($name != "label")
			{
				$output .= self::getAttributeValue($name, $value);
			}
		}
		
		$output .= '>';
		
		foreach($this->element->getOptions() as $option)
		{
			$output .= $option;
		}
		
		$output .= '</select>';
		
		return $output;
	}
}