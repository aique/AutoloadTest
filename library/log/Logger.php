<?php

class Library_Log_Logger
{
	private $traceFile;
	private $dbFile;
	private $errorFile;
	
	public function __construct()
	{
		$this->traceFile = PROJECT_PATH . '/data/logs/trace';
		$this->dbFile = PROJECT_PATH . '/data/logs/db';
		$this->errorFile = PROJECT_PATH . '/data/logs/error';
	}
	
	public function logTrace($message)
	{
		$handler = fopen($this->traceFile . '.' . date("d.m.Y"), 'a');
		
		if(Library_Manage_ResourceManager::getAppConfig()->getCurrentEnvironment() != Application_Consts_EnvironmentConst::PRODUCTION_ENV)
		{
			$script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
			$time = date('H:i:s');
			fwrite($handler, $time .' ( ' . $script_name . ' ) ' . $message . "\n");
		}
		
		fclose($handler);
	}
	
	public function logQuerySQL($query)
	{
		if(Library_Manage_ResourceManager::getAppConfig()->getCurrentEnvironment() != Application_Consts_EnvironmentConst::PRODUCTION_ENV)
		{
			$handler = fopen($this->dbFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, "Query\n-----\n" . $query . "\n\n");
			fclose($handler);
		}
	}
	
	public function logQueryResult($result)
	{
		if(Library_Manage_ResourceManager::getAppConfig()->getCurrentEnvironment() != Application_Consts_EnvironmentConst::PRODUCTION_ENV)
		{
			$handler = fopen($this->dbFile . '.' . date("d.m.Y"), 'a');
			fwrite($handler, "Result\n------\n" . $result . "\n\n");
			fclose($handler);
		}
	}
	
	public function logError(Exception $exception)
	{
		$handler = fopen($this->errorFile . '.' . date("d.m.Y"), 'a');
		
		fwrite($handler, "Fatal error\n-----------\n\n");
		fwrite($handler, "File: " . $exception->getFile()."\n");
		fwrite($handler, "Line: " . $exception->getLine()."\n");
		fwrite($handler, "Message: " . $exception->getMessage()."\n");
		fwrite($handler, "Trace: " . $exception->getTraceAsString()."\n\n");
		
		fclose($handler);
	}
	
}