<?php

class Application_Controllers_IndexController extends Library_Qframe_Controller_BaseController
{
	public function init()
	{
		$this->view['logged_user'] = Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Session::LOGGED_USER);
		
		$this->addPlugin(new Application_Plugins_ACLPlugin());
	}
	
	public function indexAction()
	{
		$form = new Application_Forms_LoginForm();
		
		if(Library_Qframe_Manage_InputManager::isPost())
		{
			$form->setParams(Library_Qframe_Manage_InputManager::getParams(Library_Qframe_Manage_InputManager::POST));
			
			if($form->isValid())
			{
				$name = Library_Qframe_Manage_InputManager::getParam("usuario", Library_Qframe_Manage_InputManager::POST);
				$pass = Library_Qframe_Manage_InputManager::getParam("password", Library_Qframe_Manage_InputManager::POST);
				
				$userModel = new Application_Model_User();
				$user = $userModel->loginUser($name, $pass);
				
				if($user)
				{
					Library_Qframe_Manage_SessionManager::setVar(Library_Qframe_Consts_Session::LOGGED_USER, $user);
					
 					$this->helper->redirect(new Library_Qframe_Request_Request("cms", "user", "list"));
				}
				else
				{
					$form->setError("Nombre o contraseña no válida");
				}
			}
		}
		
		$this->view["form"] = $form;
		
		// throw new Exception("Error previsto.");
	}
	
	public function logoutAction()
	{
		Library_Qframe_Manage_SessionManager::setVar(Library_Qframe_Consts_Session::LOGGED_USER, null);
		
		$this->helper->redirect(new Library_Qframe_Request_Request(Library_Qframe_Request_Request::MODULE_DEFAULT_VALUE,
 													    		   Library_Qframe_Request_Request::CONTROLLER_DEFAULT_VALUE,
 																   Library_Qframe_Request_Request::ACTION_DEFAULT_VALUE));
	}
	
}