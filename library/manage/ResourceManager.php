<?php

/**
 * Clase que filtra el acceso a los distintos recursos del sistema.
 * 
 * Realiza las tareas previas necesarias antes de permitir el acceso
 * a estos recursos y los almacena en el sistema si fuera necesario.
 * 
 * @author qinteractiva
 */
class Library_Manage_ResourceManager
{
	public static function getConfig()
	{
		$config = Library_Manage_SessionManager::getVar(Library_Consts_Application::APP_CONFIG);
		
		if(!$config)
		{
			$config = new Library_App_Config();
			
			Library_Manage_SessionManager::setVar(Library_Consts_Application::APP_CONFIG, $config);
		}
		
		return $config;
	}
	
	public static function getI18nData()
	{
		$i18n = Library_Manage_SessionManager::getVar(Library_Consts_Application::I18N);
		
		if(!$i18n)
		{
			$i18n = new Library_I18n_I18nData();
	
			Library_Manage_SessionManager::setVar(Library_Consts_Application::I18N, $i18n);
		}
		
		return $i18n;
	}
	
	public static function getRequestData()
	{
		$request = Library_Request_URLParser::parse($_SERVER['REQUEST_URI']);
		
		Library_Manage_SessionManager::setVar(Library_Consts_Application::REQUEST, $request);
		
		return $request;
	}
	
	public static function getAclData()
	{
		$acl = Library_Manage_SessionManager::getVar(Library_Consts_Application::ACL);
		
		if(!$acl)
		{
			$acl = new Library_ACL_ACL();
			
			Library_Manage_SessionManager::setVar(Library_Consts_Application::ACL, $acl);
		}
		
		return $acl;
	} 
	
	public static function getLogger()
	{
		$logger = Library_Manage_SessionManager::getVar(Library_Consts_Application::LOGGER);
	
		if(!$logger)
		{
			$logger = new Library_Log_Logger();
	
			Library_Manage_SessionManager::setVar(Library_Consts_Application::LOGGER, $logger);
		}
	
		return $logger;
	}
	
}