<?php

class Application_Plugins_ACLPlugin extends Library_Qframe_Plugin_BasePlugin
{
	public function preDispatch(Library_Qframe_Request_Request $request)
	{
		$acl = $this->createAclObject();
		
		$user = Library_Qframe_Manage_SessionManager::getVar(Library_Qframe_Consts_Session::LOGGED_USER);
		
		if($user)
		{
 			if(!$acl->isAllowed($user->getRole(), $request->getResource()))
 			{
 				$request->setModule(Library_Qframe_Request_Request::MODULE_DEFAULT_VALUE);
 				$request->setController(Library_Qframe_Request_Request::CONTROLLER_DEFAULT_VALUE);
 				$request->setAction(Library_Qframe_Request_Request::ACTION_DEFAULT_VALUE);
 				$request->setParams(array());
 			}
		}
	}
	
	private function createAclObject()
	{
		$acl = Library_Qframe_Manage_ResourceManager::getAclData();
			
		$request = new Library_Qframe_Request_Request(Library_Qframe_Request_Request::MODULE_DEFAULT_VALUE,
											   		  Library_Qframe_Request_Request::CONTROLLER_DEFAULT_VALUE,
											   		  Library_Qframe_Request_Request::ACTION_DEFAULT_VALUE);
		
		$acl->addResource($request->getResource(), "guest");
		$acl->addResource($request->getResource(), "admin");
		
		// da permiso al administrador para acceder a todos los action del controlador user
 		$request = new Library_Qframe_Request_Request("cms", "user", Library_Qframe_ACL_Consts::ALL_ACTIONS_ALLOWED);
 		$acl->addResource($request->getResource(), "admin");
		
		// ejemplo de asignación de permisos por action
		
// 		$request = new Library_Qframe_Request_Request("cms", "user", "insert");
// 		$acl->addResource($request->getResource(), "admin");
		
// 		$request = new Library_Qframe_Request_Request("cms", "user", "update");
// 		$acl->addResource($request->getResource(), "admin");
		
// 		$request = new Library_Qframe_Request_Request("cms", "user", "detail");
// 		$acl->addResource($request->getResource(), "admin");
		
// 		$request = new Library_Qframe_Request_Request("cms", "user", "detailJSON");
// 		$acl->addResource($request->getResource(), "admin");
		
// 		$request = new Library_Qframe_Request_Request("cms", "user", "list");
// 		$acl->addResource($request->getResource(), "admin");
		
// 		$request = new Library_Qframe_Request_Request("cms", "user", "delete");
// 		$acl->addResource($request->getResource(), "admin");
		
		$request = new Library_Qframe_Request_Request(Library_Qframe_Request_Request::MODULE_DEFAULT_VALUE,
													  Library_Qframe_Request_Request::CONTROLLER_DEFAULT_VALUE,
													  "logout");
		
		$acl->addResource($request->getResource(), "admin");
		
		return $acl;
	}
}