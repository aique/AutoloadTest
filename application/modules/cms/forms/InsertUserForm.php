<?php

class Application_Modules_Cms_Forms_InsertUserForm extends Library_Qframe_Html_Element_BaseForm
{
	public function init()
	{
		$this->addAttribute("id", "insert_form");
		
		$this->setLegend("Datos del usuario");
		
		$this->addAttribute("class", "form-horizontal");
		
		$name = new Library_Qframe_Html_Element_Input(array("type" => "text", "id" => "name", "name" => "name", "label" => "nombre"),
											   array(Library_Qframe_Html_Const_ValidationRuleConst::REQUIRED => true,
													 Library_Qframe_Html_Const_ValidationRuleConst::FORMAT => Library_Qframe_Html_Const_ValidationRuleConst::ALPHABETICAL_FORMAT));
		
		$password = new Library_Qframe_Html_Element_Input(array("type" => "password", "id" => "password", "name" => "password", "label" => "contraseña"),
												   array(Library_Qframe_Html_Const_ValidationRuleConst::REQUIRED => true,
													     Library_Qframe_Html_Const_ValidationRuleConst::FORMAT => Library_Qframe_Html_Const_ValidationRuleConst::ALPHANUMERIC_FORMAT));
		
		$passConf = new Library_Qframe_Html_Element_Input(array("type" => "password", "id" => "pass_conf", "name" => "pass_conf", "label" => "confirmación"),
												   array(Library_Qframe_Html_Const_ValidationRuleConst::REQUIRED => true,
													     Library_Qframe_Html_Const_ValidationRuleConst::FORMAT => Library_Qframe_Html_Const_ValidationRuleConst::ALPHANUMERIC_FORMAT,
													     Library_Qframe_Html_Const_ValidationRuleConst::FIELD_VALUE => "password"));
		
		$email = new Library_Qframe_Html_Element_Input(array("type" => "email", "id" => "email", "name" => "email", "label" => "email"),
											    array(Library_Qframe_Html_Const_ValidationRuleConst::REQUIRED => true,
											    	  Library_Qframe_Html_Const_ValidationRuleConst::FORMAT => Library_Qframe_Html_Const_ValidationRuleConst::EMAIL));
		
		$role = new Library_Qframe_Html_Element_Select(array("name" => "role", "id" => "role", "label" => "rol"));
		
		$role->addOption(new Library_Qframe_Html_Element_Option(array("value" => "admin", "display" => "Administrador")));
		$role->addOption(new Library_Qframe_Html_Element_Option(array("value" => "guest", "display" => "Invitado")));
		
		$married = new Library_Qframe_Html_Element_Checkbox(array("type" => "checkbox", "value" => "1", "id" => "married", "name" => "married", "label" => "Está casado"),
													 array(Library_Qframe_Html_Const_ValidationRuleConst::REGEX => '/^1$/'));
		
		$radioNumChild1 = new Library_Qframe_Html_Element_Radio(array("type" => "radio", "value" => "0", "id" => "childNum1", "name" => "childNum", "label" => "Sin hijos"));
		
		$radioNumChild2 = new Library_Qframe_Html_Element_Radio(array("type" => "radio", "value" => "1", "id" => "childNum2", "name" => "childNum", "label" => "Tengo 1 hijo"));
		
		$radioNumChild3 = new Library_Qframe_Html_Element_Radio(array("type" => "radio", "value" => "2", "id" => "childNum3", "name" => "childNum", "label" => "Tengo 2 hijos"));
		
		$radioNumChild4 = new Library_Qframe_Html_Element_Radio(array("type" => "radio", "value" => "3", "id" => "childNum4", "name" => "childNum", "label" => "Tengo 3 hijos"));
		
		$radioNumChild5 = new Library_Qframe_Html_Element_Radio(array("type" => "radio", "value" => "4", "id" => "childNum5", "name" => "childNum", "label" => "Tengo 4 hijos"));
		
		$radioGroupNumChild = new Library_Qframe_Html_Element_RadioGroup(array("name" => "childNum"));
		
		$radioGroupNumChild->addRadio($radioNumChild1);
		$radioGroupNumChild->addRadio($radioNumChild2);
		$radioGroupNumChild->addRadio($radioNumChild3);
		$radioGroupNumChild->addRadio($radioNumChild4);
		$radioGroupNumChild->addRadio($radioNumChild5);
		
		$jobDesc = new Library_Qframe_Html_Element_TextArea(array("id" => "jobDesc", "name" => "jobDesc", "rows" => "10", "cols" => "40", "label" => "Descripción de su empleo"));
				
		$submit = new Library_Qframe_Html_Element_Input(array("type" => "submit", "value" => Library_Qframe_I18n_I18n::getText("screen_common_form_submit")));
		
		$this->addElement($name);
		$this->addElement($password);
		$this->addElement($passConf);
		$this->addElement($email);
		$this->addElement($role);
		$this->addElement($married);
		$this->addElement($radioGroupNumChild);
		$this->addElement($jobDesc);
		$this->addAction($submit);
	}
}