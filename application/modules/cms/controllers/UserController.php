<?php

class Application_Modules_Cms_Controllers_UserController extends Library_Controller_BaseController
{
	public function init()
	{
		if(!Library_Manage_SessionManager::getVar(Application_Consts_AppConst::LOGGED_USER))
		{
			// Si no hay un usuario logueado redirigir a la pantalla de login antes de atender
			// la petición
			
 			$this->helper->redirect(new Library_Request_Request(Library_Request_Request::MODULE_DEFAULT_VALUE,
 													    		Library_Request_Request::CONTROLLER_DEFAULT_VALUE,
 																Library_Request_Request::ACTION_DEFAULT_VALUE));
		}
	}
	
	public function listAction()
	{
		$userModel = new Application_Model_User();
	
		$users = $userModel->getAllUsers();
	
		$this->view["users"] = $users;
		
		$this->view["paginator"] = new Library_Paginator_Paginator($users, Library_Manage_ResourceManager::getAppConfig()->getVar("users.paginator.itemsPerPage"));
	}
}