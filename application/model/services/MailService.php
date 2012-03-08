<?php

class Application_Model_Services_MailService
{
	public static function sendWellcomeMail($user)
	{
		$receivers = array($user->getEmail());
	
		$subject = "Bienvenido";
		
		$args = array();
		
		$template = "wellcome";
	
		Library_Mail_MailManager::sendMail($receivers, $subject, $args, $template);
	}
}