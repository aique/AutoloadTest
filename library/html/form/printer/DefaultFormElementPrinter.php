<?php

abstract class Library_Html_Form_Printer_DefaultFormElementPrinter extends Library_Html_Printer_ElementBasePrinter
{
	public function __construct(Library_Html_Form_FormElement $element)
	{
		parent::__construct($element);
	}
	
	public function standardPrint()
	{
		$output = '';
	
		$output .= $this->printLabel();
	
		$output .= $this->printElement();
	
		return $output;
	}
	
	protected function printLabel()
	{
		$output = '';
	
		$attributes = $this->element->getAttributes();
	
		if(array_key_exists('label', $attributes) && array_key_exists('id', $attributes))
		{
			$output .= '<label for="'.$attributes['id'].'">'.$attributes['label'].'</label>';
		}
	
		return $output;
	}
	
	protected abstract function printElement();
}