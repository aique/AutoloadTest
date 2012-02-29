<?php

/**
 * Clase que se comporta como una capa superior de acceso a la configuración de la
 * aplicación. Comprueba que el objeto de configuración de la aplicación se encuentre
 * inicializado y guardado en sesión. Si no es así realiza estas acciones.
 */
class Library_Manage_ResourceManager
{
	public static function getAppConfig()
	{
		$appConfig = Library_Manage_SessionManager::getVar(Application_Consts_AppConst::APP_CONFIG_SESSION_NAME);
		
		if(!$appConfig)
		{
			$appConfig = new Library_Config_AppConfig();
			
			Library_Manage_SessionManager::setVar(Application_Consts_AppConst::APP_CONFIG_SESSION_NAME, $appConfig);
		}
		
		return $appConfig;
	}
	
	public static function getI18nData()
	{
		$i18n = Library_Manage_SessionManager::getVar(Application_Consts_AppConst::I18N_DATA_SESSION_NAME);
		
		if(!$i18n)
		{
			$i18n = new Library_I18n_I18nData();
	
			Library_Manage_SessionManager::setVar(Application_Consts_AppConst::I18N_DATA_SESSION_NAME, $i18n);
		}
		
		return $i18n;
	}
	
	public static function getURLData()
	{
		$url = Library_Manage_SessionManager::getVar(Application_Consts_AppConst::URL_DATA_SESSION_NAME);
	
		if(!$url)
		{
			$url = Library_URL_URLParser::parse($_SERVER['REQUEST_URI'], new Library_URL_URLData());
	
			Library_Manage_SessionManager::setVar(Application_Consts_AppConst::URL_DATA_SESSION_NAME, $url);
		}
	
		return $url;
	}
	
}