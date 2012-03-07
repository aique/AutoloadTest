<?php

class Library_Controller_ControllerHelper
{
	public function redirect(Library_Request_Request $request)
	{
		Library_Manage_SessionManager::setVar(Application_Consts_AppConst::REQUEST, $request);
		
		// Library_App_Dispatcher::dispatchRequest($url);
		
		header("Location: " . $request);
	}
}