<?php

class Library_Manage_URLManager
{
	public static function loadURLData()
	{
		$urlData = Library_URL_URLParser::parse($_SERVER['REQUEST_URI'], new Library_URL_URLData());

		Library_Manage_SessionManager::setVar(Application_Consts_AppConst::URL_DATA_SESSION_NAME, $urlData);

		return $urlData;
	}

	public static function getURLData()
	{
		$url = Library_Manage_SessionManager::getVar(Application_Consts_AppConst::URL_DATA_SESSION_NAME);

		if(!$url)
		{
			$url = self::loadURLData();
		}

		return $url;
	}
}