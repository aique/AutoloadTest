<?php

class Application_Plugins_ACLPlugin extends Library_Plugin_BasePlugin
{
	public function preDispatch(Library_Controller_BaseController $controller)
	{
		$acl = $this->createAclObject();
		
		$user = Library_Manage_SessionManager::getVar(Library_Consts_Application::LOGGED_USER);
		
		if($user)
		{
 			if(!$acl->isAllowed($user->getRole(), $controller->getRequest()->__toString()))
 			{
 				$controller->getHelper()->redirect(new Library_Request_Request(Library_Request_Request::MODULE_DEFAULT_VALUE,
 																			   Library_Request_Request::CONTROLLER_DEFAULT_VALUE,
 																			   Library_Request_Request::ACTION_DEFAULT_VALUE));
 			}
		}
	}
	
	private function createAclObject()
	{
		$acl = Library_Manage_SessionManager::getVar(Library_Consts_Application::ACL);
		
		if(!$acl)
		{
			$acl = new Library_ACL_ACL();
			
			$resource = new Library_Request_Request(Library_Request_Request::MODULE_DEFAULT_VALUE,
													Library_Request_Request::CONTROLLER_DEFAULT_VALUE,
													Library_Request_Request::ACTION_DEFAULT_VALUE);
			
			$acl->addResource($resource->__toString(), "guest");
			$acl->addResource($resource->__toString(), "admin");
			
			$resource = new Library_Request_Request("cms", "user", "list");
			
			$acl->addResource($resource->__toString(), "admin");
			
			Library_Manage_SessionManager::setVar(Library_Consts_Application::ACL, $acl);
		}
		
		return $acl;
	}
}