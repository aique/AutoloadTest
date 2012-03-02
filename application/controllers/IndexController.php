<?php

class Application_Controllers_IndexController extends Library_Controller_BaseController
{
	public function indexAction($view)
	{
		$form = new Application_Forms_LoginForm();
		
		if(Library_Manage_InputManager::isPost())
		{
			$form->setParams(Library_Manage_InputManager::getParams(Library_Manage_InputManager::POST));
			
			if($form->isValid())
			{
				$this->helper->redirect(new Library_URL_URL("users", "user", "list"));
			}
		}
		
		$view["form"] = $form;
		
		return $view;
	}
}