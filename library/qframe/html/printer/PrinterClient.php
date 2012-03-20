<?php

class Library_Qframe_Html_Printer_PrinterClient
{
	public static function getDefaultTemplate(Library_Qframe_Html_Element_FormElement $element)
	{
		$template = null;
		
		switch($element->getName())
		{
			case(Library_Qframe_Html_Const_FormElementConst::FORM):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/form.php';
				break;
			
			case(Library_Qframe_Html_Const_FormElementConst::INPUT):
				$template = self::getInputDefaultTemplate($element);
				break;
				
			case(Library_Qframe_Html_Const_FormElementConst::SELECT):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/select.php';
				break;
				
			case(Library_Qframe_Html_Const_FormElementConst::OPTION):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/option.php';
				break;
				
			case(Library_Qframe_Html_Const_FormElementConst::RADIO_GROUP):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/radiogroup.php';
				break;
				
			case(Library_Qframe_Html_Const_FormElementConst::TEXT_AREA):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/textarea.php';
				break;
				
			default:
				throw new Exception('El elemento que se está analizando, cuyo nombre es ' . $this->element->getName() . ', no está soportado.');
				break;
		}
		
		return $template;
	}
	
	private static function getInputDefaultTemplate(Library_Qframe_Html_Element_FormElement $element)
	{
		$template = null;
		
		switch($element->getAttribute('type'))
		{
			case('text'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/text.php';
				break;
				
			case('email'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/email.php';
				break;
				
			case('password'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/password.php';
				break;
				
			case('radio'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/radio.php';
				break;
				
			case('checkbox'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/checkbox.php';
				break;
				
			case('submit'):
				$template = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("html.templatesPath") . 'default/form/elements/input/submit.php';
				break;
				
			default:
				throw new Exception('El atributo type del elemento input que se está analizando, cuyo valor es ' . $this->element->getAttribute('type') . ', no está soportado.');
				break;
		}
		
		return $template;
	}
	
}