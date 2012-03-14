<?php

class Library_Html_Form_Element_Input extends Library_Html_Form_FormElement
{
	public function __construct(array $attributes = array(),
								array $validations = array(),
								Library_Html_Form_Printer_DefaultFormElementPrinter $printer = null)
	{	
		if($printer == null)
		{
			$printer = new Library_Html_Form_Printer_DefaultInputPrinter();
		}
		
		$printer->setElement($this);
		
		parent::__construct(Library_Html_Form_FormElementConst::INPUT, $attributes, $validations, $printer);
	}
}