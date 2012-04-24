<?php

class Application_Modules_Cms_Controllers_UserController extends Library_Qframe_Controller_BaseController
{
	public function init()
	{
		if(!Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Session::LOGGED_USER))
		{
			$this->helper->redirect(new Library_Qframe_Request_Request(Library_Qframe_Request_Request::MODULE_DEFAULT_VALUE,
 																	   Library_Qframe_Request_Request::CONTROLLER_DEFAULT_VALUE,
 																	   Library_Qframe_Request_Request::ACTION_DEFAULT_VALUE));
		}
		else
		{
			$this->addPlugin(new Application_Plugins_ACLPlugin());
			
			$this->view->addContent('logged_user', Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Session::LOGGED_USER));
			
			// $this->addPlugin(new Application_Modules_Cms_Plugins_WellcomeMailPlugin());
		}
	}
	
	public function listAction()
	{
		$itemsPerPage = Library_Qframe_Manage_InputManager::getParam("items_per_page");
		
		if($itemsPerPage)
		{
			Library_Qframe_Manage_SessionManager::setVar("items_per_page", $itemsPerPage);
		}
		else
		{
			$itemsPerPage = Library_Qframe_Manage_SessionManager::getVar("items_per_page");
			
			if(!$itemsPerPage)
			{
				$itemsPerPage = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("users.paginator.itemsPerPage");
			}
		}
		
		$visiblePages = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("users.paginator.visiblePages");
		
		$currentPage = $this->getRequest()->getParam("page");
		
		if(!$currentPage)
		{
			$currentPage = 0;
		}
		
		$userModel = new Application_Model_User();
	
		$users = $userModel->getAllUsers(($currentPage - 1) * $itemsPerPage, $itemsPerPage);
	
		$this->view->addContent("users", $users);
		
		$this->view->addContent("paginator", new Library_Qframe_Paginator_Paginator($userModel->getNumUsers(), $itemsPerPage, $visiblePages));
	}
	
	public function insertAction()
	{
		$form = new Application_Modules_Cms_Forms_InsertUserForm();
		
		if(Library_Qframe_Manage_InputManager::isPost())
		{
			$params = Library_Qframe_Manage_InputManager::getParams(Library_Qframe_Manage_InputManager::POST);
			
			$form->setParams($params);
				
			if($form->isValid())
			{
				$userModel = new Application_Model_User();
				
				if($userModel->insertUser(new Application_Model_User_Item($params)))
				{
					$this->helper->redirect(new Library_Qframe_Request_Request("cms", "user", "list"));
				}
				else
				{
					$form->setError("El usuario no se ha podido guardar.");
				}
			}
		}
		
		$this->view->addContent("form", $form);
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
				$this->view->addContent("user", $user);
				
				$form = new Application_Modules_Cms_Forms_InsertUserForm();
				
				$form->setParams($user->getAttributesAsArray());
					
				$this->view->addContent("form", $form);
				
				if(Library_Qframe_Manage_InputManager::isPost())
				{
					$params = Library_Qframe_Manage_InputManager::getParams(Library_Qframe_Manage_InputManager::POST);
					
					$form->setParams($params);
					
					$user->setAttributesFromArray($params);
					
					if($form->isValid())
					{
						if($userModel->updateUser($user))
						{
							$this->helper->redirect(new Library_Qframe_Request_Request("cms", "user", "detail", array("id" => $user->getId())));
						}
						else
						{
							$form->setError("El usuario no se ha podido modificar.");
						}
					}
				}
			}
		}
		else
		{
			$this->helper->redirect(new Library_Qframe_Request_Request("cms", "user", "list"));
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
				$this->view->addContent("user", $user);
			}
			else
			{
				$this->helper->redirect(new Library_Qframe_Request_Request("cms", "user", "list"));
			}
		}
	}
	
	/**
	 * Action que devuelve los datos asociados a la vista en formato JSON
	 */
	public function detailJSONAction()
	{
		// establecemos el contexto de respuesta como JSON
		$this->setContext(Library_Qframe_Controller_ControllerConsts::JSON_ACTION_CONTEXT);
		
		$id = $this->getRequest()->getParam("id");
		
		if(Application_Model_User_Validator::validateUserId($id))
		{
			$userModel = new Application_Model_User();
				
			$user = $userModel->getUser($id);
				
			if($user)
			{
				$this->view->addJsonContent("user", $user);
			}
			else
			{
				$this->helper->redirect(new Library_Qframe_Request_Request("cms", "user", "list"));
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
		
		$this->helper->redirect(new Library_Qframe_Request_Request("cms", "user", "list"));
	}
}