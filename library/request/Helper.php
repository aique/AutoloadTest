<?php

/**
 * Clase auxiliar con funcionalidad común para el tratamiento de peticiones.
 * 
 * @package library
 * 
 * @subpackage request
 * 
 * @author qinteractiva
 *
 */
class Library_Request_Helper
{
	/**
	 * Identifica la existencia de un módulo a partir de su nombre dentro de la
	 * estructura de la aplicación.
	 * 
	 * @param string $moduleName
	 * 
	 * 		Nombre del módulo del cual se quiere identificar su existencia.
	 * 
	 * @return
	 * 
	 * 		Devuelve true en caso de que el módulo exista y false en caso contrario.
	 */
	public static function isModule($moduleName)
	{
		if(!empty($moduleName))
		{
			if(file_exists(PROJECT_PATH . "/application/modules/" . $moduleName))
			{
				return true;
			}
		}
		
		return false;
	}
}