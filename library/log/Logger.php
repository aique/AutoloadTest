<?php

class Library_Log_Logger
{
	private $traceFile;
	private $errorFile;
	private $traceFileHandler;
	private $errorFileHandler;
	
	private static $logger;
	
	public function __construct()
	{
		$this->traceFile = PROJECT_PATH . '/data/logs/trace';
		$this->errorFile = PROJECT_PATH . '/data/logs/error';
		
		$this->traceFileHandler = fopen($this->traceFile . '.' . date("d.m.Y"), 'a');
		$this->errorFileHandler = fopen($this->errorFile . '.' . date("d.m.Y"), 'a');
	}
	
	public function __destruct()
	{
		fclose($this->traceFileHandler);
		fclose($this->errorFileHandler);
	}
	
	public static function getLogger()
	{
		if(self::$logger == null)
		{
			self::$logger = new Library_Log_Logger();
		}
	
		return self::$logger;
	}
	
	public function log($message, $messageType)
	{
		switch($messageType)
		{
			case(Library_Log_LogMessageType::TRACE):
				$this->printTraceMessage($message);
				break;
			case(Library_Log_LogMessageType::ERROR):
				$this->printErrorMessage($message);
				break;
			default:
				throw new Exception("Tipo de mensaje inválido, se ha encontrado " . $messageType . ".");
		}
	}
	
	private function printTraceMessage($message)
	{
		if(Library_Manage_AppConfigManager::getCurrentEnvironment() != Application_Consts_EnvironmentConst::PRODUCTION_ENV)
		{
			$script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
			$time = date('H:i:s');
			fwrite($this->traceFileHandler, $time .' ( ' . $script_name . ' ) ' . $message . "\n");
		}
	}
	
	private function printErrorMessage($message)
	{
		$script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
		$time = date('H:i:s');
		fwrite($this->errorFileHandler, $time .' ( ' . $script_name . ' ) ' . $message . "\n");
	}
	
	
}