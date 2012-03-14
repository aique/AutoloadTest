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
		
		$output .= $this->printOptions($this->element->getOptions(), $this->element->getValue());
		
		$output .= '</select><br />';
		
		return $output;
	}
	
	private function printOptions($options, $selectedValue)
	{
		$output = '';
		
		foreach($options as $option)
		{
			if($option->getValue() == $selectedValue)
			{
				$option->addAttribute('selected', 'selected');
			}
			
			$output .= $option;
		}
		
		return $output;
	}
}