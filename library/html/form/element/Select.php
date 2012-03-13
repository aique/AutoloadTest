<?php

class Library_Html_Form_Element_Select extends Library_Html_Form_FormElement
{
	private $options;
	
	public function __construct(array $attributes = array(),
								array $validations = array())
	{
		parent::__construct(Library_Html_Form_FormElementConst::SELECT, $attributes, $validations);
		
		$this->printer = new Library_Html_Form_Printer_DefaultSelectPrinter($this);
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