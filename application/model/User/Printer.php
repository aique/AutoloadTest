<?php

class Application_Model_User_Printer extends Library_Qframe_Model_ItemPrinter
{
	public function standardPrint()
	{
		
	}
	
	public function paginationPrint()
	{
		return
		
	    $this->element->getId().' - '.
	    '<a href="'.new Library_Qframe_Request_Request("cms", "user", "detail", array("id" => $this->element->getId())).'">'.$this->element->getName().'</a> '.
	    '<a class="action" id="delete_action_'.$this->element->getId().'" href="'.new Library_Qframe_Request_Request("cms", "user", "delete", array("id" => $this->element->getId())).'">'.Library_Qframe_I18n_I18n::getText("screen_user_list_delete").'</a> '.
	    '<a class="action" id="update_action_'.$this->element->getId().'" href="'.new Library_Qframe_Request_Request("cms", "user", "update", array("id" => $this->element->getId())).'">'.Library_Qframe_I18n_I18n::getText("screen_user_list_update").'</a>';
	}
	
	public function profilePrint()
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
	
}