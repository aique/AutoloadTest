<?php

class Library_Html_Form_Printer_DefaultFormPrinter extends Library_Html_Printer_ElementBasePrinter
{
	public function __construct(Library_Html_Form_BaseForm $form = null)
	{
		$this->element = $form;
	}
	
	public function printHTML()
	{
		$output = '';
		
		$output .= $this->getError();
		
		$output .= '<form';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			$output .= self::getAttributeValue($name, $value);
		}
		
		$output .= '/>';
		
		foreach($this->element->getElements() as $element)
		{
			$output .= $element;
		}
		
		$output .= '</form>';
		
		return $output;
	}
	
	private function getError()
	{
		$error = $this->element->getError();
		
		if($error != null)
		{
			return '<p class="form_error">'.$error.'</p>';
		}
		
		return "";
	}
	
}