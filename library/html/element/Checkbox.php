<?php

class Library_Html_Element_Checkbox extends Library_Html_Element_FormElement
{
	public function __construct(array $attributes = array(),
								array $validations = array(),
								$template = null)
	{
		parent::__construct(Library_Html_Const_FormElementConst::INPUT, $attributes, $validations, $template, new Library_Html_Printer_CheckboxPrinter());
	}

	public function getValue()
	{
		if($this->getAttribute('checked'))
		{
			return $this->getAttribute('value');
		}
		else
		{
			return 0;
		}
	}
	
	public function setValue($value)
	{
		if($value != 0)
		{
			$this->addAttribute('checked', 'checked');
		}
	}
}