<?php

class Application_Model_User_Printer extends Library_Printer_BasePrinter
{
	public function standardPrint()
	{
		$output = '';
		
		$output .= '<dl class="dl-horizontal">';

		$output .= $this->printAttribute('Nombre', $this->element->getName());
		$output .= $this->printAttribute('Email', $this->element->getEmail());
		$output .= $this->printAttribute('Rol', $this->element->getRole());
		$output .= $this->printAttribute('Está casado', $this->element->getMarried());
		$output .= $this->printAttribute('Número de hijos', $this->element->getChildNum());
		$output .= $this->printAttribute('Descripción de su trabajo', $this->element->getJobDesc());
			
		$output .= '</dl>';
		
		return $output;
	}
	
	private function printAttribute($name, $value)
	{
		if(!empty($value))
		{
			return '<dt>'.$name.'</dt><dd>'.$value.'</dd>';
		}
		else
		{
			return '';
		}
	}
	
	public function paginationPrint()
	{
		$output = '';
		
		$output .= $this->element->getId().' - ';
		$output .= '<a href="'.new Library_Request_Request("cms", "user", "detail", array("id" => $this->element->getId())).'">'.$this->element->getName().'</a> ';
		$output .= '<a class="action" href="'.new Library_Request_Request("cms", "user", "delete", array("id" => $this->element->getId())).'">'.Library_I18n_I18n::getText("screen_user_list_delete").'</a> ';
		$output .= '<a class="action" href="'.new Library_Request_Request("cms", "user", "update", array("id" => $this->element->getId())).'">'.Library_I18n_I18n::getText("screen_user_list_update").'</a>';
		
		return $output;
	}
	
}