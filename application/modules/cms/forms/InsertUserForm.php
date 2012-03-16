<?php

class Application_Modules_Cms_Forms_InsertUserForm extends Library_Html_Form_BaseForm
{
	public function init()
	{
		$this->setLegend("Datos del usuario");
		
		$this->addAttribute("class", "form-horizontal");
		
		$name = new Library_Html_Form_Element_Input(array("type" => "text", "id" => "name", "name" => "name", "label" => "nombre"),
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
		
		$role = new Library_Html_Form_Element_Select(array("name" => "role", "id" => "role", "label" => "rol"));
		
		$role->addOption(new Library_Html_Form_Element_Option(array("value" => "admin", "display" => "Administrador")));
		$role->addOption(new Library_Html_Form_Element_Option(array("value" => "guest", "display" => "Invitado")));
		
		$married = new Library_Html_Form_Element_Input(array("type" => "checkbox", "value" => "1", "id" => "married", "name" => "married", "display" => "Está casado"),
													   array(),
													   new Library_Html_Form_Printer_DefaultCheckboxPrinter());
		
		$radioNumChild1 = new Library_Html_Form_Element_Input(array("type" => "radio", "value" => "0", "id" => "childNum", "name" => "childNum", "display" => "Sin hijos"),
															  array(),
															  new Library_Html_Form_Printer_DefaultRadioPrinter());
		
		$radioNumChild2 = new Library_Html_Form_Element_Input(array("type" => "radio", "value" => "1", "id" => "childNum", "name" => "childNum", "display" => "Tengo 1 hijo"),
															  array(),
															  new Library_Html_Form_Printer_DefaultRadioPrinter());
		
		$radioNumChild3 = new Library_Html_Form_Element_Input(array("type" => "radio", "value" => "2", "id" => "childNum", "name" => "childNum", "display" => "Tengo 2 hijos"),
															  array(),
															  new Library_Html_Form_Printer_DefaultRadioPrinter());
		
		$radioNumChild4 = new Library_Html_Form_Element_Input(array("type" => "radio", "value" => "3", "id" => "childNum", "name" => "childNum", "display" => "Tengo 3 hijos"),
															  array(),
															  new Library_Html_Form_Printer_DefaultRadioPrinter());
		
		$radioNumChild5 = new Library_Html_Form_Element_Input(array("type" => "radio", "value" => "4", "id" => "childNum", "name" => "childNum", "display" => "Tengo 4 hijos"),
															  array(),
															  new Library_Html_Form_Printer_DefaultRadioPrinter());
		
		$radioGroupNumChild = new Library_Html_Form_Element_RadioGroup(array("name" => "childNum"));
		
		$radioGroupNumChild->addRadio($radioNumChild1);
		$radioGroupNumChild->addRadio($radioNumChild2);
		$radioGroupNumChild->addRadio($radioNumChild3);
		$radioGroupNumChild->addRadio($radioNumChild4);
		$radioGroupNumChild->addRadio($radioNumChild5);
		
		$radioNumChild5 = new Library_Html_Form_Element_Input(array("type" => "radio", "value" => "4", "id" => "childNum", "name" => "childNum", "display" => "Tengo 4 hijos"),
															  array(),
															  new Library_Html_Form_Printer_DefaultRadioPrinter());
		
		$jobDesc = new Library_Html_Form_Element_TextArea(array("id" => "jobDesc", "name" => "jobDesc", "rows" => "10", "cols" => "40", "label" => "Descripción de su empleo"),
														  array());
				
		$submit = new Library_Html_Form_Element_Input(array("type" => "submit", "value" => Library_I18n_I18n::getText("screen_common_form_submit")));
		
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