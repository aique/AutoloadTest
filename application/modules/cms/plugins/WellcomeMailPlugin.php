<?php

class Application_Modules_Cms_Plugins_WellcomeMailPlugin extends Library_Plugin_BasePlugin
{
	public function postDispatch(Library_Request_Request $request)
	{
		Application_Model_Services_MailService::sendWellcomeMail(Library_Manage_SessionManager::getVar(Library_Consts_Application::LOGGED_USER));
	}
}