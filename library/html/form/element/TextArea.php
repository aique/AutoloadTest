<?php

class Library_Html_Form_Element_TextArea extends Library_Html_Form_FormElement
{
	public function __construct(array $attributes = array(),
								array $validations = array(),
								Library_Html_Form_Printer_DefaultFormElementPrinter $printer = null)
	{
		if($printer == null)
		{
			$printer = new Library_Html_Form_Printer_DefaultTextAreaPrinter();
		}

		$printer->setElement($this);

		parent::__construct(Library_Html_Form_FormElementConst::TEXT_AREA, $attributes, $validations, $printer);
	}
	
	public function setValue($value)
	{
		$this->addAttribute('display', $value);
	}
}