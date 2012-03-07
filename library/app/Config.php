<?php

/**
 * Clase que contine la configuración de la aplicación.
 * 
 * Inicialmente se ha de hacer un volcado de los ficheros de configuración al
 * array de parámetros que contiene esta clase. Una vez hecho esto, la manera de
 * acceder a estos valores será a través de esta clase.
 */
class Library_App_Config
{
	private $configVars;
	private $currentEnvironment;
	
	public function __construct()
	{
		$this->configVars = Library_Util_ConfigFileParser::parse(PROJECT_PATH . '/application/configs/config.ini');
		$this->currentEnvironment = DEFAULT_ENVIRONMENT;
	}
	
	/**
	 * Devuelve el valor del atributo configVars.
	 *
	 * @return array
	 */
	public function getConfigVars()
	{
	    return $this->configVars;
	}
	 
	/**
	 * Establece el valor del atributo configVars.
	 *
	 * @param array $configVars
	 */
	public function setConfigVars($configVars)
	{
	    $this->configVars = $configVars;
	}
	
	public function getVar($name)
	{
		return $this->configVars[$this->currentEnvironment][$name];
	}
	
	public function getCurrentEnvironment()
	{
		return $this->currentEnvironment;
	}
	
	public function setCurrentEnvironment($currentEnvironment)
	{
		$this->currentEnvironment = $currentEnvironment;
	}
}