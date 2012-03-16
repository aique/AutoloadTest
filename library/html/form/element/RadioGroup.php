<?php

class Library_Html_Form_Element_RadioGroup extends Library_Html_Form_FormElement
{
	private $radios;
	
	public function __construct(array $attributes = array(),
							   array $validations = array(),
							   Library_Html_Form_Printer_DefaultFormElementPrinter $printer = null)
	{
		$this->radios = array();
		
		$printer = new Library_Html_Form_Printer_DefaultRadioGroupPrinter();
		$printer->setElement($this);
		
		parent::__construct(Library_Html_Form_FormElementConst::RADIO_GROUP, $attributes, $validations, $printer);
	}
	
	/**
	 * Devuelve el valor del atributo radios.
	 *
	 * @return array
	 */
	public function getRadios()
	{
	    return $this->radios;
	}
	 
	/**
	 * Establece el valor del atributo radios.
	 *
	 * @param array $radios
	 */
	public function setRadios(array $radios)
	{
	    $this->radios = $radios;
	}
	
	public function addRadio(Library_Html_Form_Element_Input $radio)
	{
		$this->radios[] = $radio;
	}
	
	public function setValue($value)
	{
		$settedValue = false;
		
		$radios = $this->radios;
		
		for($i = 0 ; $i < count($radios) && !$settedValue ; $i++)
		{
			if($radios[$i]->getAttributeByName('value') == $value)
			{
				$radios[$i]->addAttribute('checked', 'checked');
			}
		}
	}
	
	public function isRadioChecked()
	{
		foreach($this->radios as $radio)
		{
			if($radio->getAttributeByName('checked'))
			{
				return true;
			}
		}
		
		return false;
	}
	
}