<?php

class Library_Html_Form_Element_Input extends Library_Html_Form_FormElement
{
	public function __construct(array $attributes = array(),
								array $validations = array())
	{		
		parent::__construct(Library_Html_Form_FormElementConst::INPUT, $attributes, $validations);
		
		$this->printer = new Library_Html_Form_Printer_DefaultInputPrinter($this);
	}
}