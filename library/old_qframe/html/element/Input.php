<?php

class Library_Qframe_Html_Element_Input extends Library_Qframe_Html_Element_FormElement
{
	public function __construct(array $attributes = array(),
								array $validations = array(),
								$template = null)
	{	
		parent::__construct(Library_Qframe_Html_Const_FormElementConst::INPUT, $attributes, $validations, $template, new Library_Qframe_Html_Printer_InputPrinter());
	}
}