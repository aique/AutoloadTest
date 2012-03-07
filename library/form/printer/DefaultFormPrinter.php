<?php

class Library_Form_Printer_DefaultFormPrinter
{
	private $form;
	
	public function __construct(Library_Form_BaseForm $form = null)
	{
		$this->form = $form;
	}
	
	public function printHTML()
	{
		$output = '';
		
		$action = $this->form->getAction();
		$error = $this->form->getError();
		
		if($action == Library_Form_BaseForm::DEFAULT_ACTION)
		{
			$action = Library_Manage_ResourceManager::getRequestData();
		}
		
		if($error != null)
		{
			$output .= '<p class="form_error">'.$error.'</p>';
		}
		
		$output .= '<form action="'.$action.'" method="'.$this->form->getMethod().'" enctype="'.$this->form->getEnctype().'">';
		
		foreach($this->form->getElements() as $element)
		{
			$output .= $element;
		}
		
		$output .= '</form>';
		
		return $output;
	}
}