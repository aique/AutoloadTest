<?php

class Library_Controller_ControllerHelper
{
	public function redirect(Library_URL_URL $url)
	{
		header("Location: http://" . Library_Manage_ResourceManager::getAppConfig()->getVar("app.name") . $url);
	}
}