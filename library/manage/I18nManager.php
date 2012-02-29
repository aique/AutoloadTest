<?php

class Library_Manage_I18nManager
{
	public static function loadI18nData()
	{
		$i18nData = new Library_I18n_I18nData();
	
		Library_Manage_SessionManager::setVar(Application_Consts_AppConst::I18N_DATA_SESSION_NAME, $i18nData);
	
		return $i18nData;
	}
	
	public static function getI18nData()
	{
		$i18n = Library_Manage_SessionManager::getVar(Application_Consts_AppConst::I18N_DATA_SESSION_NAME);
	
		if(!$i18n)
		{
			$i18n = self::loadI18nData();
		}
		
		return $i18n;
	}
}