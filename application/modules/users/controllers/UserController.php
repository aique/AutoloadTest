<?php

class Application_Modules_Users_Controllers_UserController
{
	public function listAction($view)
	{
		Library_Log_Logger::getLogger()->log("Llamando a la función listAction del controlador User", Library_Log_LogMessageType::TRACE);
		
		$userModel = new Application_Modules_Users_Model_User();
	
		$users = $userModel->getAllUsers();
	
		$view["users"] = $users;
		
		$view["paginator"] = new Library_Paginator_Paginator($view["users"], Library_Manage_ResourceManager::getAppConfig()->getVar("users.paginator.itemsPerPage"));
	
		return $view;
	}
}