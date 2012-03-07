<?php

class Application_Plugins_ACLPlugin extends Library_Plugin_BasePlugin
{
	public function preDispatch(Library_Request_Request $request)
	{
		$acl = $this->createAclObject();
		
		$user = Library_Manage_SessionManager::getVar(Application_Consts_AppConst::LOGGED_USER);
		
		if($user)
		{
			if(!$acl->isAllowed($request->__toString(), $user->getRole()))
			{
				$request->setModule(Library_Request_Request::MODULE_DEFAULT_VALUE);
				$request->setController(Library_Request_Request::CONTROLLER_DEFAULT_VALUE);
				$request->setAction(Library_Request_Request::ACTION_DEFAULT_VALUE);
			}
		}
		
		return $request;
	}
	
	private function createAclObject()
	{
		$acl = Library_Manage_SessionManager::getVar(Application_Consts_AppConst::ACL);
		
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
		}
		
		return $acl;
	}
}