<?php

abstract class Library_Printer_BasePrinter
{
	protected $element;
	
	public function __construct($element)
	{
		$this->element = $element;
	}
	
	public abstract function standardPrint();
}