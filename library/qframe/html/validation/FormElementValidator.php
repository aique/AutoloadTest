<?php

class Library_Qframe_Html_Validation_FormElementValidator
{
	private $form;
	
	public function __construct(Library_Qframe_Html_Element_BaseForm $form)
	{
		$this->form = $form;
	}
	
	public function validateElement(Library_Qframe_Html_Element_FormElement $element)
	{
		foreach($element->getValidations() as $ruleName => $ruleValue)
		{
			$isValid = Library_Qframe_Html_Validation_FormElementValidator::validateRule($ruleName, $ruleValue, $element->getValue());
			  
			if($isValid != 1)
			{
				$element->setError($isValid);
				
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
			case(Library_Qframe_Html_Const_ValidationRuleConst::REQUIRED):
				$isValid = self::validateRequiredField($ruleValue, $elementValue);
				break;
				
			case(Library_Qframe_Html_Const_ValidationRuleConst::FORMAT):
				$isValid = self::validateFormat($ruleValue, $elementValue);
				break;
				
			case(Library_Qframe_Html_Const_ValidationRuleConst::FIELD_VALUE):
				$isValid = self::validateFieldValue($ruleValue, $elementValue);
				break;
				
			case(Library_Qframe_Html_Const_ValidationRuleConst::REGEX):
				$isValid = self::validateRegexExpression($ruleValue, $elementValue);
				break;
		}
		
		return $isValid;
	}
	
	private function validateRequiredField($ruleValue, $elementValue)
	{
		if($ruleValue == true)
		{
			if(empty($elementValue))
			{
				return Library_Qframe_I18n_I18n::getText('screen_common_error_required');
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
	
	private function validateFormat($ruleValue, $elementValue)
	{
		$isValid = true;
		
		switch($ruleValue)
		{
			case(Library_Qframe_Html_Const_ValidationRuleConst::NUMERIC_FORMAT):
				
				if(!preg_match('/^[1-9][0-9]*$/', $elementValue))
				{
					$isValid = Library_Qframe_I18n_I18n::getText('screen_common_error_numeric_required');
				}
				
				break;
				
			case(Library_Qframe_Html_Const_ValidationRuleConst::ALPHABETICAL_FORMAT):
				
				if(!preg_match('/^[A-Za-z]*$/', $elementValue))
				{
					$isValid = Library_Qframe_I18n_I18n::getText('screen_common_error_alphabetical_required');
				}
				
				break;
				
			case(Library_Qframe_Html_Const_ValidationRuleConst::ALPHANUMERIC_FORMAT):
				
				if(!$isValid = preg_match('/^[A-Za-z1-9]*$/', $elementValue))
				{
					$isValid = Library_Qframe_I18n_I18n::getText('screen_common_error_alphanumeric_required');
				}
				
				break;
				
			case(Library_Qframe_Html_Const_ValidationRuleConst::EMAIL):
				
				if(!preg_match('/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/', $elementValue))
				{
					$isValid = Library_Qframe_I18n_I18n::getText('screen_common_error_email_required');
				}
				
				break;
				
			default:
				
				throw new Exception('Se está intentando validar un campo de formularion con una norma de formato no aceptada: ' . $ruleValue . '.');
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
			else
			{
				return Library_Qframe_I18n_I18n::getText('screen_common_error_invalid_value');
			}
		}
		else
		{
			return false;
		}
	}
	
	private function validateRegexExpression($ruleValue, $elementValue)
	{
		if(preg_match($ruleValue, $elementValue))
		{
			return true;
		}
		else
		{
			return Library_Qframe_I18n_I18n::getText('screen_common_error_invalid_value');
		}
	}
	
}