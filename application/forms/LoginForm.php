<?php

class Application_Forms_LoginForm extends Library_Qframe_Html_Element_BaseForm
{
	public function init()
	{
		$this->setLegend("Login");
		
		$this->addAttribute("id", "login_form");
		$this->addAttribute("class", "form-horizontal");
		
		$username = new Library_Qframe_Html_Element_Input(array("type" => "text", "id" => "usuario", "name" => "usuario", "label" => "usuario"),
												   		  array(Library_Qframe_Html_Const_ValidationRuleConst::REQUIRED => true,
													      Library_Qframe_Html_Const_ValidationRuleConst::FORMAT => Library_Qframe_Html_Const_ValidationRuleConst::ALPHABETICAL_FORMAT));
		
		$password = new Library_Qframe_Html_Element_Input(array("type" => "password", "id" => "password", "name" => "password", "label" => "contraseña"),
												   		  array(Library_Qframe_Html_Const_ValidationRuleConst::REQUIRED => true,
													      Library_Qframe_Html_Const_ValidationRuleConst::FORMAT => Library_Qframe_Html_Const_ValidationRuleConst::ALPHANUMERIC_FORMAT));
		
		$submit = new Library_Qframe_Html_Element_Input(array("type" => "submit", "value" => "Enviar"));
		
		$this->addElement($username);
		$this->addElement($password);
		$this->addAction($submit);
	}
}