<?php

class Library_Html_Form_FormElementValidator
{
	public static function validateRule($ruleName, $ruleValue, $elementValue)
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
		}
		
		return $isValid;
	}
	
	private static function validateRequiredField($ruleValue, $elementValue)
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
	
	private static function validateFormat($ruleValue, $elementValue)
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
				
			default:
				throw new Exception("Se está intentando validar un campo de formularion con una norma de formato no aceptada: " . $ruleValue . '.');
		}
		
		return $isValid;
	}
	
}