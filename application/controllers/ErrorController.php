<?php

class Application_Controllers_ErrorController extends Library_Qframe_Controller_BaseController
{
	public function init()
	{
		$this->view->addContent("logged_user", Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Session::LOGGED_USER));
	}
	
	public function errorAction()
	{
		
	}
	
	public function pageNotFoundAction()
	{
		
	}
}