<?php

class Library_Controller_ControllerHelper
{
	public function redirect(Library_URL_URL $url)
	{
		Library_App_Dispatcher::dispatchRequest($url);
		
		// header("Location: " . $url);
	}
}