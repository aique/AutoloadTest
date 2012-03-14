<?php

class Library_Html_Form_Element_Select extends Library_Html_Form_FormElement
{
	private $options;
	
	public function __construct(array $attributes = array(),
								array $validations = array(),
								Library_Html_Form_Printer_DefaultFormElementPrinter $printer = null)
	{
		if($printer == null)
		{
			$printer = new Library_Html_Form_Printer_DefaultSelectPrinter();
		}
		
		$printer->setElement($this);
		
		parent::__construct(Library_Html_Form_FormElementConst::SELECT, $attributes, $validations, $printer);
	}
	
	/**
	 * Devuelve el valor del atributo options.
	 *
	 * @return array
	 */
	public function getOptions()
	{
	    return $this->options;
	}
	 
	/**
	 * Establece el valor del atributo options.
	 *
	 * @param array $options
	 */
	public function setOptions($options)
	{
	    $this->options = $options;
	}
	
	public function addOption(Library_Html_Form_Element_Option $option)
	{
		$this->options[] = $option;
	}
	
}