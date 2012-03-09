<?php

class Application_Modules_Cms_Forms_InsertUserForm extends Library_Html_Form_BaseForm
{
	public function init()
	{
		$name = new Library_Html_Form_Element_Input(array("type" => "text", "id" => "name", "name" => "name", "label" => "name"),
													array(Library_Html_Form_ValidationRuleConst::REQUIRED => true,
														  Library_Html_Form_ValidationRuleConst::FORMAT => Library_Html_Form_ValidationRuleConst::ALPHABETICAL_FORMAT));
		
		$password = new Library_Html_Form_Element_Input(array("type" => "password", "id" => "password", "name" => "password", "label" => "contraseña"),
														array(Library_Html_Form_ValidationRuleConst::REQUIRED => true,
															  Library_Html_Form_ValidationRuleConst::FORMAT => Library_Html_Form_ValidationRuleConst::ALPHANUMERIC_FORMAT));
		
		$passConf = new Library_Html_Form_Element_Input(array("type" => "password", "id" => "pass_conf", "name" => "pass_conf", "label" => "confirmación"),
														array(Library_Html_Form_ValidationRuleConst::REQUIRED => true,
															  Library_Html_Form_ValidationRuleConst::FORMAT => Library_Html_Form_ValidationRuleConst::ALPHANUMERIC_FORMAT,
															  Library_Html_Form_ValidationRuleConst::FIELD_VALUE => "password"));
		
		$email = new Library_Html_Form_Element_Input(array("type" => "email", "id" => "email", "name" => "email", "label" => "email"),
													 array(Library_Html_Form_ValidationRuleConst::REQUIRED => true,
														   Library_Html_Form_ValidationRuleConst::FORMAT => Library_Html_Form_ValidationRuleConst::EMAIL));
		
		$role = new Library_Html_Form_Element_Select(array("name" => "role", "id" => "role"));
		
		$role->addOption(new Library_Html_Form_Element_Option(array("value" => "admin", "display" => "Administrador")));
		$role->addOption(new Library_Html_Form_Element_Option(array("value" => "guest", "display" => "Invitado")));
		
		$submit = new Library_Html_Form_Element_Input(array("type" => "submit", "value" => Library_I18n_I18n::getText("screen_common_form_submit")));
		
		$this->addElement($name);
		$this->addElement($password);
		$this->addElement($passConf);
		$this->addElement($email);
		$this->addElement($role);
		$this->addElement($submit);
	}
}