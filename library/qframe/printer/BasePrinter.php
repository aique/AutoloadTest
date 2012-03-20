<?php

abstract class Library_Qframe_Printer_BasePrinter
{
	protected $element;
	
	public function getElement()
	{
	    return $this->element;
	}
	 
	public function setElement($element)
	{
	    $this->element = $element;
	}
	
	public abstract function standardPrint();
}