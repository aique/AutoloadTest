<?php

class Application_Modules_Cms_Plugins_WellcomeMailPlugin extends Library_Qframe_Plugin_BasePlugin
{
	public function postDispatch(Library_Qframe_Request_Request $request)
	{
		Application_Model_Services_MailService::sendWellcomeMail(Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Session::LOGGED_USER));
	}
}