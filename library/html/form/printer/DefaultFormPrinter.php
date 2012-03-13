<?php

class Library_Html_Form_Printer_DefaultFormPrinter extends Library_Html_Printer_ElementBasePrinter
{
	public function __construct(Library_Html_Form_BaseForm $form)
	{
		parent::__construct($form);
	}
	
	public function standardPrint()
	{
		$output = '';
		
		$output .= $this->printError();
		
		$output .= '<form';
		
		$output .= $this->printAttributes($this->element);
		
		$output .= '/>';
		
		$output .= '<fieldset>';
		
		$output .= '<legend>'.$this->element->getLegend().'</legend>';
		
		$output .= $this->printElements($this->element);
		
		$output .= $this->printActions($this->element);
		
		$output .= '</fieldset>';
		
		$output .= '</form>';
		
		return $output;
	}
	
	private function printError()
	{
		$error = $this->element->getError();
	
		if($error != null)
		{
			return '<p class="form_error">'.$error.'</p>';
		}
	
		return "";
	}
	
	private function printAttributes($form)
	{
		$output = '';
		
		foreach($this->element->getAttributes() as $name => $value)
		{
			$output .= self::printAttribute($name, $value);
		}
		
		return $output;
	}
	
	private function printElements($form)
	{
		$output = '';
		
		foreach($form->getElements() as $element)
		{
			$output .= $element;
		}
		
		return $output;
	}
	
	private function printActions($form)
	{
		$output = '<div class="form-actions">';
		
		foreach($this->element->getActions() as $action)
		{
			$output .= $action;
		}
		
		$output .= '</div>';
		
		return $output;
	}
	
}