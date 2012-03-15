<?php

class Library_Host_Printer extends Library_Printer_BasePrinter
{
	public function standardPrint()
	{
		
	}
	
	public function logPrint()
	{
		$output = '';
		
		$output .= "Los datos del host son los siguientes:\n\n";
		$output .= "IP: " . $this->element->getIp() . "\n";
		$output .= "Host: " . $this->element->getHost() . "\n";
		$output .= "Proxy: " . $this->element->getProxy() . "\n\n";
		
		return $output;
		
	}
}