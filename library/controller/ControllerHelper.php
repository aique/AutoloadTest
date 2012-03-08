<?php

class Library_Controller_ControllerHelper
{
	public function redirect(Library_Request_Request $request)
	{
		Library_Manage_SessionManager::setVar(Library_Consts_Application::REQUEST, $request);
		
		header("Location: " . $request);
	}
}