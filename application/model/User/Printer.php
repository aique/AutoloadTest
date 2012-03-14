<?php

class Application_Model_User_Printer extends Library_Printer_BasePrinter
{
	public function standardPrint()
	{
		return
		
	    $this->element->getId().' - '.
	    '<a href="'.new Library_Request_Request("cms", "user", "detail", array("id" => $this->element->getId())).'">'.$this->element->getName().'</a> '.
	    '<a class="action" href="'.new Library_Request_Request("cms", "user", "delete", array("id" => $this->element->getId())).'">'.Library_I18n_I18n::getText("screen_user_list_delete").'</a> '.
	    '<a class="action" href="'.new Library_Request_Request("cms", "user", "update", array("id" => $this->element->getId())).'">'.Library_I18n_I18n::getText("screen_user_list_update").'</a>';
	}
	
	public function profilePrint()
	{
		$output = '';
		
		$name = $this->element->getName();
		$email = $this->element->getEmail();
		$role = $this->element->getRole();
		
		if(empty($name) && empty($email) && empty($role))
		{
			$output .= '<p>No se han encontrado datos de este usuario.</p>';
		}
		else
		{
			$output .= '<dl class="dl-horizontal">';

			$output .= $this->printAttribute('Nombre', $name);
			$output .= $this->printAttribute('Email', $email);
			$output .= $this->printAttribute('Rol', $role);
			
			$output .= '</dl>';
		}
		
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