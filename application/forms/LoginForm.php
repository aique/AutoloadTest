<?php

class Application_Forms_LoginForm extends Library_Html_Form_BaseForm
{
	public function init()
	{
		$this->addAttribute("id", "login_form");
		
		$username = new Library_Html_Form_Element_Input(array("type" => "text", "id" => "usuario", "name" => "usuario", "label" => "usuario"),
												   		array(Library_Html_Form_ValidationRuleConst::REQUIRED => true,
														 	  Library_Html_Form_ValidationRuleConst::FORMAT => Library_Html_Form_ValidationRuleConst::ALPHABETICAL_FORMAT));
		
		$password = new Library_Html_Form_Element_Input(array("type" => "password", "id" => "password", "name" => "password", "label" => "contraseña"),
												   		array(Library_Html_Form_ValidationRuleConst::REQUIRED => true,
															  Library_Html_Form_ValidationRuleConst::FORMAT => Library_Html_Form_ValidationRuleConst::ALPHANUMERIC_FORMAT));
		
		$submit = new Library_Html_Form_Element_Input(array("type" => "submit", "value" => "Enviar"));
		
		$this->addElement($username);
		$this->addElement($password);
		$this->addElement($submit);
	}
}