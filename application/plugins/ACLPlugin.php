<?php

class Application_Plugins_ACLPlugin extends Library_Plugin_BasePlugin
{
	public function preDispatch(Library_Request_Request $request)
	{
		$acl = $this->createAclObject();
		
		$user = Library_Manage_SessionManager::getVar(Library_Consts_Application::LOGGED_USER);
		
		if($user)
		{
 			if(!$acl->isAllowed($user->getRole(), $request->getResource()))
 			{
 				$request->setModule(Library_Request_Request::MODULE_DEFAULT_VALUE);
 				$request->setController(Library_Request_Request::CONTROLLER_DEFAULT_VALUE);
 				$request->setAction(Library_Request_Request::ACTION_DEFAULT_VALUE);
 				$request->setParams(array());
 			}
		}
	}
	
	private function createAclObject()
	{
		$acl = Library_Manage_ResourceManager::getAclData();
			
		$request = new Library_Request_Request(Library_Request_Request::MODULE_DEFAULT_VALUE,
											   Library_Request_Request::CONTROLLER_DEFAULT_VALUE,
											   Library_Request_Request::ACTION_DEFAULT_VALUE);
		
		$acl->addResource($request->getResource(), "guest");
		$acl->addResource($request->getResource(), "admin");
			
		$request = new Library_Request_Request("cms", "user", "list");
		$acl->addResource($request->getResource(), "admin");
		
		$request = new Library_Request_Request("cms", "user", "insert");
		$acl->addResource($request->getResource(), "admin");
		
		$request = new Library_Request_Request("cms", "user", "update");
		$acl->addResource($request->getResource(), "admin");
		
		$request = new Library_Request_Request("cms", "user", "detail");
		$acl->addResource($request->getResource(), "admin");
		
		$request = new Library_Request_Request("cms", "user", "delete");
		$acl->addResource($request->getResource(), "admin");
		
		return $acl;
	}
}