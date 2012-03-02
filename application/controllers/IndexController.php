<?php

class Application_Controllers_IndexController extends Library_Controller_BaseController
{
	public function indexAction($view)
	{
		Library_Log_Logger::getLogger()->log("Llamando a la función indexAction del controlador Index", Library_Log_LogMessageType::TRACE);
		
		$form = new Application_Forms_LoginForm();
		
		if(Library_Manage_InputManager::isPost())
		{
			$form->setParams(Library_Manage_InputManager::getParams(Library_Manage_InputManager::POST));
			
			if($form->isValid())
			{
				$this->redirect(new Library_URL_URL("users", "user", "list"));
			}
		}
		
		$view["form"] = $form;
		
		return $view;
	}
}