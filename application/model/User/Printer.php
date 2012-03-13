<?php

class Application_Model_User_Printer
{
	private $user;
	
	public function __construct(Application_Model_User_Item $user)
	{
		$this->user = $user;
	}
	
	public function standardPrint()
	{
		return
		
	    $this->user->id.' - <a href="'.new Library_Request_Request("cms", "user", "detail", array("id" => $this->user->getId())).'">'.$this->user->name.'</a> '.
	    '<a class="action" href="'.new Library_Request_Request("cms", "user", "delete", array("id" => $this->user->getId())).'">'.Library_I18n_I18n::getText("screen_user_list_delete").'</a> '.
	    '<a class="action" href="'.new Library_Request_Request("cms", "user", "update", array("id" => $this->user->getId())).'">'.Library_I18n_I18n::getText("screen_user_list_update").'</a>';
	}
	
	public function profilePrint()
	{
		return '<dl class="dl-horizontal"><dt>Nombre</dt><dd>'.$this->user->getName().'</dd><br /><dt>Email</dt><dd>'.$this->user->getEmail().'</dd><br /><dt>Rol</dt><dd>'.$this->user->getRole().'</dd></dl>';
	}
	
}