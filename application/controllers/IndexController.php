<?php

class Application_Controllers_IndexController extends Library_Controller_BaseController
{
	public function init()
	{
		$this->addPlugin(new Application_Plugins_ACLPlugin());
	}
	
	public function indexAction()
	{
		$form = new Application_Forms_LoginForm();
		
		if(Library_Manage_InputManager::isPost())
		{
			$form->setParams(Library_Manage_InputManager::getParams(Library_Manage_InputManager::POST));
			
			if($form->isValid())
			{
				$name = Library_Manage_InputManager::getParam("usuario", Library_Manage_InputManager::POST);
				$pass = Library_Manage_InputManager::getParam("password", Library_Manage_InputManager::POST);
				
				$userModel = new Application_Model_User();
				$user = $userModel->loginUser($name, $pass);
				
				if($user)
				{
					Library_Manage_SessionManager::setVar(Library_Consts_Session::LOGGED_USER, $user);
 					$this->helper->redirect(new Library_Request_Request("cms", "user", "list"));
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
}