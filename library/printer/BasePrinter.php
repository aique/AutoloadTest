<?php

abstract class Library_Printer_BasePrinter
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