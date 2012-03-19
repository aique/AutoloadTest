<?php

class Library_Html_Element_Input extends Library_Html_Element_FormElement
{
	public function __construct(array $attributes = array(),
								array $validations = array(),
								$template = null)
	{	
		parent::__construct(Library_Html_Const_FormElementConst::INPUT, $attributes, $validations, $template, new Library_Html_Printer_InputPrinter());
	}
}