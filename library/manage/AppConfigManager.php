<?php

/**
 * Clase que se comporta como una capa superior de acceso a la configuración de la
 * aplicación. Comprueba que el objeto de configuración de la aplicación se encuentre
 * inicializado y guardado en sesión. Si no es así realiza estas acciones.
 */
class Library_Manage_AppConfigManager
{
	public static function loadConfig()
	{
		$appConfig = Library_Config_ConfigFileParser::parse(PROJECT_PATH . '/application/configs/config.ini', new Library_Config_AppConfig());
		$appConfig->setCurrentEnvironment(DEFAULT_ENVIRONMENT);
		
		Library_Manage_SessionManager::setVar(Application_Consts_AppConst::APP_CONFIG_SESSION_NAME, $appConfig);
		
		return $appConfig;
	}
	
	public static function getVar($name)
	{
		$appConfig = Library_Manage_SessionManager::getVar(Application_Consts_AppConst::APP_CONFIG_SESSION_NAME);
		
		if(!$appConfig)
		{
			$appConfig = self::loadConfig();
		}
		
		return $appConfig->getVar($name);
	}
	
	public static function getCurrentEnvironment()
	{
		$appConfig = Library_Manage_SessionManager::getVar(Application_Consts_AppConst::APP_CONFIG_SESSION_NAME);
		
		if(!$appConfig)
		{
			$appConfig = self::loadConfig();
		}
		
		return $appConfig->getCurrentEnvironment();
	}
}