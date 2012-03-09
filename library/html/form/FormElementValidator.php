<?php

class Library_Html_Form_FormElementValidator
{
	private $form;
	
	public function __construct(Library_Html_Form_BaseForm $form)
	{
		$this->form = $form;
	}
	
	public function validateElement(Library_Html_Form_FormElement $element)
	{
		foreach($element->getValidations() as $ruleName => $ruleValue)
		{
			if(!Library_Html_Form_FormElementValidator::validateRule($ruleName, $ruleValue, $element->getValue()))
			{
				return false;
			}
		}
		
		return true;
	}
	
	private function validateRule($ruleName, $ruleValue, $elementValue)
	{
		$isValid = true;
		
		switch($ruleName)
		{
			case(Library_Html_Form_ValidationRuleConst::REQUIRED):
				$isValid = self::validateRequiredField($ruleValue, $elementValue);
				break;
				
			case(Library_Html_Form_ValidationRuleConst::FORMAT):
				$isValid = self::validateFormat($ruleValue, $elementValue);
				break;
				
			case(Library_Html_Form_ValidationRuleConst::FIELD_VALUE):
				$isValid = self::validateFieldValue($ruleValue, $elementValue);
				break;
		}
		
		return $isValid;
	}
	
	private function validateRequiredField($ruleValue, $elementValue)
	{
		if($ruleValue == true)
		{
			return !empty($elementValue);
		}
		else
		{
			return true;
		}
	}
	
	private function validateFormat($ruleValue, $elementValue)
	{
		$isValid = false;
		
		switch($ruleValue)
		{
			case(Library_Html_Form_ValidationRuleConst::NUMERIC_FORMAT):
				$isValid = preg_match('/^[1-9]*$/', $elementValue);
				break;
				
			case(Library_Html_Form_ValidationRuleConst::ALPHABETICAL_FORMAT):
				$isValid = preg_match('/^[A-Za-z]*$/', $elementValue);
				break;
				
			case(Library_Html_Form_ValidationRuleConst::ALPHANUMERIC_FORMAT):
				$isValid = preg_match('/^[A-Za-z1-9]*$/', $elementValue);
				break;
				
			case(Library_Html_Form_ValidationRuleConst::EMAIL):
				$isValid = preg_match('/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/', $elementValue);
				break;
				
			default:
				throw new Exception("Se está intentando validar un campo de formularion con una norma de formato no aceptada: " . $ruleValue . '.');
		}
		
		return $isValid;
	}
	
	/**
	 * Obtiene el valor que se ha introducido en un campo determinado cuyo
	 * atributo name encaja con el primer parámetro recibido y lo compara
	 * con el valor que recibe como segundo parámetro.
	 * 
	 * Devuelve true para el caso en el que ambos valores coincidan y false
	 * en caso contrario.
	 * 
	 * @param string $name
	 * 		Valor del atributo name del campo cuyo valor se va a comparar.
	 * 
	 * @param string $elementValue
	 * 		Valor introducido en el campo que se está evaluando.
	 * 
	 * @return boolean
	 * 		Devuelve true para el caso en el que el valor del elemento sea
	 * 		igual al otro cuyo atributo name coincide y false en caso contrario.
	 */
	private function validateFieldValue($name, $elementValue)
	{
		$element = $this->form->getElementByNameAttribute($name);
		
		if($element != null)
		{
			if($element->getValue() == $elementValue)
			{
				return true;
			}
		}
		
		return false;
	}
	
}