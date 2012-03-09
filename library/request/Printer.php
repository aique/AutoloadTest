<?php

class Library_Request_Printer
{
	private $request;
	
	public function __construct(Library_Request_Request $request)
	{
		$this->request = $request;
	}
	
	public function standardPrint()
	{
		return $this->resourcePrint() . $this->getParamsAsString();
	}
	
	public function resourcePrint()
	{
		$output = "http://" . Library_Manage_ResourceManager::getConfig()->getVar("app.name");
		
		$module = $this->getModuleAsString();
		$controller = $this->getControllerAsString();
		$action = $this->getActionAsString();
		
		if(!empty($module) || !empty($controller) || !empty($action))
		{
			$output .= $module . $controller . $action;
		}
		
		return $output;
	}
	
	private function getModuleAsString()
	{
		$output = "";
	
		if($this->request->getModule() != Library_Request_Request::MODULE_DEFAULT_VALUE)
		{
			$output = "/" . $this->request->getModule();
		}
	
		return $output;
	}
	
	private function getControllerAsString()
	{
		$output = "";
	
		if($this->request->getController() != Library_Request_Request::CONTROLLER_DEFAULT_VALUE)
		{
			$output = "/" . $this->request->getController();
		}
	
		return $output;
	}
	
	private function getActionAsString()
	{
		$output = "";
	
		if($this->request->getAction() != Library_Request_Request::ACTION_DEFAULT_VALUE)
		{
			if($this->request->getController() != Library_Request_Request::CONTROLLER_DEFAULT_VALUE)
			{
				$output = "/" . $this->request->getAction();
			}
			else
			{
				$output = $this->request->getAction();
			}
		}
	
		return $output;
	}
	
	private function getParamsAsString()
	{
		$output = "";
	
		foreach($this->request->getParams() as $paramName => $paramValue)
		{
			$output .= "/" . $paramName . "/" . $paramValue;
		}
	
		return $output;
	}
	
}