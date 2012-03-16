<?php

class Library_Html_Form_Printer_DefaultRadioGroupPrinter extends Library_Html_Form_Printer_DefaultFormElementPrinter
{
	public function printElement()
	{
		$output = '<div class="radio_group">';
		
		$radioChecked = $this->element->isRadioChecked();
		
		$radios = $this->element->getRadios();
		
		for($i = 0 ; $i < count($radios) ; $i++)
		{
			if($i == 0 && !$radioChecked)
			{
				$radios[$i]->addAttribute('checked', 'checked');
			}
			
			$output .= $radios[$i];
		}
		
		$output .= '</div>';
		
		return $output;
	}
}