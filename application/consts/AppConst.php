<?php

/**
 * Declaración de constantes utilizadas de manera interna por la aplicación.
 * 
 * Hacen referencia a las constantes utilizadas en sesión para almacenar los
 * objetos necesarios para arrancar la aplicación.
 * 
 * Se encuentran almacenadas en una clase estática ya que no se preveen
 * actualizaciones periódicas de sus valores.
 */
class Application_Consts_AppConst
{
	const APP_CONFIG = "app_config";
	
	const LOGGED_USER = "logged_user";
	
	const REQUEST = "request_data";
	const I18N = "i18n_data";
	const ACL = "acl_data";
	const LOGGER = "logger";
}