<?php

class Library_Html_Form_Element_Input extends Library_Html_Form_FormElement
{
	private $value;
	
	public function __construct(array $attributes, array $validations = array(), Library_Printer_BaseDefaultPrinter $printer = null)
	{
		if($printer == null)
		{
			$printer = new Library_Html_Form_Printer_DefaultInputPrinter($this);
		}
		
		parent::__construct(Library_Html_Form_FormElementConst::INPUT, $attributes, $validations, $printer);
	}
	
	/**
	 * Devuelve el valor del atributo value.
	 *
	 * @return string
	 */
	public function getValue()
	{
	    return $this->value;
	}
	 
	/**
	 * Establece el valor del atributo value.
	 *
	 * @param string $value
	 */
	public function setValue($value)
	{
	    $this->value = $value;
	}
	
	public function isValid()
	{
		foreach($this->validations as $ruleName => $ruleValue)
		{
			if(!Library_Html_Form_FormElementValidator::validateRule($ruleName, $ruleValue, $this->value))
			{
				return false;
			}
		}
		
		return true;
	}
}