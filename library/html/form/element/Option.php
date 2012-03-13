<?php

class Library_Html_Form_Element_Option extends Library_Html_Form_FormElement
{
	public function __construct(array $attributes = array(),
								array $validations = array())
	{
		parent::__construct(Library_Html_Form_FormElementConst::OPTION, $attributes, $validations);
		
		$this->printer = new Library_Html_Form_Printer_DefaultOptionPrinter($this);
	}
	
}