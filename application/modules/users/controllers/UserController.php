<?php

class Application_Modules_Users_Controllers_UserController extends Library_Controller_BaseController
{
	public function listAction($view)
	{
		$userModel = new Application_Modules_Users_Model_User();
	
		$users = $userModel->getAllUsers();
	
		$view["users"] = $users;
		
		$view["paginator"] = new Library_Paginator_Paginator($view["users"], Library_Manage_ResourceManager::getAppConfig()->getVar("users.paginator.itemsPerPage"));
	
		return $view;
	}
}