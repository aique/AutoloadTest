<?php

class Application_Controllers_IndexController
{
	public function indexAction($view)
	{
		Library_Log_Logger::getLogger()->log("Llamando a la función indexAction del controlador Index", Library_Log_LogMessageType::TRACE);
		
		return $view;
	}
}