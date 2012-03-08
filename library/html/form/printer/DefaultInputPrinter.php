<?php

class Library_Html_Form_Printer_DefaultInputPrinter extends Library_Html_Printer_ElementBasePrinter
{
	public function printHTML()
	{
		$output = '';
		
		$attributes = $this->element->getAttributes();
		
		if(array_key_exists('label', $attributes) && array_key_exists('id', $attributes))
		{
			$output = $this->printInputWithLabel($attributes['label'], $attributes['id']);
		}
		else
		{
			$output = $this->printInput();
		}
		
		return $output;
	}
	
	private function printInputWithLabel($label, $id)
	{
		$output = '<label for="'.$id.'">'.$label.'</label>: ';
		
		$output .= self::printInput($this->element); 
	
		return $output;
	}
	
	private function printInput()
	{
		$output = '<input';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			if($name != "label")
			{
				$output .= self::getAttributeValue($name, $value);
			}
		}
		
		$output .= ' /><br />';
		
		return $output;
	}
}