<?php

class Application_Modules_Cms_Controllers_UserController extends Library_Controller_BaseController
{
	public function init()
	{
		if(!Library_Manage_SessionManager::getVar(Library_Consts_Session::LOGGED_USER))
		{
			$this->helper->redirect(new Library_Request_Request(Library_Request_Request::MODULE_DEFAULT_VALUE,
 													    		Library_Request_Request::CONTROLLER_DEFAULT_VALUE,
 																Library_Request_Request::ACTION_DEFAULT_VALUE));
		}
		else
		{
			$this->addPlugin(new Application_Plugins_ACLPlugin());
			
			// $this->addPlugin(new Application_Modules_Cms_Plugins_WellcomeMailPlugin());
		}
	}
	
	public function listAction()
	{
		$userModel = new Application_Model_User();
	
		$users = $userModel->getAllUsers();
	
		$this->view["users"] = $users;
		
		$this->view["paginator"] = new Library_Paginator_Paginator($users, Library_Manage_ResourceManager::getConfig()->getVar("users.paginator.itemsPerPage"));
	}
	
	public function insertAction()
	{
		$form = new Application_Modules_Cms_Forms_InsertUserForm();
		
		if(Library_Manage_InputManager::isPost())
		{
			$params = Library_Manage_InputManager::getParams(Library_Manage_InputManager::POST);
			
			$form->setParams($params);
				
			if($form->isValid())
			{
				$userModel = new Application_Model_User();
				
				if($userModel->insertUser(new Application_Model_User_Item($params)))
				{
					$this->helper->redirect(new Library_Request_Request("cms", "user", "list"));
				}
				else
				{
					$form->setError("El usuario no se ha podido guardar.");
				}
			}
			else
			{
				$form->setError("Los parámetros no son correctos.");
			}
		}
		
		$this->view["form"] = $form;
	}
	
	public function updateAction()
	{
		$id = $this->getRequest()->getParam("id");
		
		if(Application_Model_User_Validator::validateUserId($id))
		{
			$userModel = new Application_Model_User();
				
			$user = $userModel->getUser($id);
			
			if($user)
			{
				$this->view["user"] = $user;
				
				$form = new Application_Modules_Cms_Forms_InsertUserForm();
				
				$form->setParams($user->getAttributesAsArray());
					
				$this->view["form"] = $form;
				
				if(Library_Manage_InputManager::isPost())
				{
					$params = Library_Manage_InputManager::getParams(Library_Manage_InputManager::POST);
					
					$form->setParams($params);
					
					$user->setAttributesFromArray($params);
					
					if($form->isValid())
					{
						if($userModel->updateUser($user))
						{
							$this->helper->redirect(new Library_Request_Request("cms", "user", "detail", array("id" => $user->getId())));
						}
						else
						{
							$form->setError("El usuario no se ha podido modificar.");
						}
					}
					else
					{
						$form->setError("Los parámetros no son correctos.");
					}
				}
			}
		}
		else
		{
			$this->helper->redirect(new Library_Request_Request("cms", "user", "list"));
		}
	}
	
	public function detailAction()
	{
		$id = $this->getRequest()->getParam("id");
		
		if(Application_Model_User_Validator::validateUserId($id))
		{
			$userModel = new Application_Model_User();
			
			$user = $userModel->getUser($id);
			
			if($user)
			{
				$this->view["user"] = $user;
			}
			else
			{
				$this->helper->redirect(new Library_Request_Request("cms", "user", "list"));
			}
		}
	}
	
	public function deleteAction()
	{
		$id = $this->getRequest()->getParam("id");
		
		if(Application_Model_User_Validator::validateUserId($id))
		{
			$userModel = new Application_Model_User();
				
			$user = $userModel->deleteUser($id);
		}
		
		// TODO Crear un sistema de mensajes estándar para mostrar los resultados de las operaciones
		
		$this->helper->redirect(new Library_Request_Request("cms", "user", "list"));
	}
	
}