<?php

class Library_Log_Logger
{
	// Archivos
	private $dbTraceFile;
	private $dbErrorFile;
	private $traceFile;
	private $errorFile;
	
	// Rutas
	private $mailPath;
	
	public function __construct()
	{
		$this->dbTraceFile = PROJECT_PATH . '/data/logs/db/trace';
		$this->dbErrorFile = PROJECT_PATH . '/data/logs/db/error';
		$this->traceFile = PROJECT_PATH . '/data/logs/trace/trace';
		$this->errorFile = PROJECT_PATH . '/data/logs/error/error';
		$this->mailPath = PROJECT_PATH . '/data/mail/';
	}
	
	public function logTrace($message)
	{
		if(Library_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Consts_Environment::PRODUCTION_ENV)
		{
			$content = date('H:i:s') .' ( ' . pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) . ' ) ' . $message . "\n";
			
			$handler = fopen($this->traceFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, $content);
			fclose($handler);
		}
	}
	
	public function logDBConnection(Library_Manage_DBManager $dbManager)
	{
		if(Library_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Consts_Environment::PRODUCTION_ENV)
		{
			$content = "Conexión\n--------\n\n";
			$content .= "Hora: " . date("H:i:s") . "\n";
			$content .= "Se ha producido una conexión con los datos:\n\n";
			$content .= "Servidor: " . $dbManager->getServer() . "\n";
			$content .= "Base de datos: " . $dbManager->getDbName() . "\n";
			$content .= "Usuario: " . $dbManager->getUser() . "\n\n";
			$content .= Library_Manage_ResourceManager::getHostData()->getPrinter()->logPrint();
			
			$handler = fopen($this->dbTraceFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, $content);
			fclose($handler);
		}
	}
	
	public function logDBQuery($query)
	{
		if(Library_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Consts_Environment::PRODUCTION_ENV)
		{
			$content = "Consulta\n--------\n\n";
			$content .= "Hora: " . date("H:i:s\n") . "\n";
			$content .= $query . "\n\n";
			$content .= Library_Manage_ResourceManager::getHostData()->getPrinter()->logPrint();
			
			$handler = fopen($this->dbTraceFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, $content);
			fclose($handler);
		}
	}
	
	public function logDBConnectionError($error)
	{
		if(Library_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Consts_Environment::PRODUCTION_ENV)
		{
			$content = "Error\n----\n\n";
			$content .= "Hora: " . date("H:i:s\n");
			$content .= "Archivo: " . pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) . "\n\n";
			$content .= "Mensaje: " . $error . "\n\n";
			$content .= Library_Manage_ResourceManager::getHostData()->getPrinter()->logPrint();
			
			$handler = fopen($this->dbErrorFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, $content);
			fclose($handler);
		}
	}
	
	public function logDBQueryError($query)
	{
		if(Library_Manage_ResourceManager::getConfig()->getCurrentEnvironment() != Library_Consts_Environment::PRODUCTION_ENV)
		{
			$content = "Error\n----\n\n";
			$content .= "Hora: " . date("H:i:s\n");
			$content .= "Archivo: " . pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME) . "\n\n";
			$content .= "Mensaje: Error en base de datos al ejecutar una consulta SQL.\n\n";
			$content .= "Consulta:\n" . $query . "\n\n";
			$content .= Library_Manage_ResourceManager::getHostData()->getPrinter()->logPrint();
				
			$handler = fopen($this->dbErrorFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, $content);
			fclose($handler);
		}
	}
	
	public function logError($exception)
	{
		$content = "Error\n-----\n\n";
		$content .= "Hora: " . date("H:i:s\n");
		$content .= "Fichero: " . $exception->getFile()."\n";
		$content .= "Línea: " . $exception->getLine()."\n";
		$content .= "Mensaje: " . $exception->getMessage()."\n";
		$content .= "Traza de ejecución:\n" . $exception->getTraceAsString()."\n\n";
		
		$handler = fopen($this->errorFile . '.' . date("d.m.Y"), 'a');
		fwrite($handler, $content);
		fclose($handler);
	}
	
	public function logMail($html, $name)
	{
		$handler = fopen($this->mailPath . $name, 'w');
		fwrite($handler, $html);
		fclose($handler);
	}
	
}