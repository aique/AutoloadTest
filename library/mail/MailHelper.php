<?php

class Library_Mail_MailHelper
{
	public static function createPHPMailerObject($users)
	{
		$phpMailer = new Library_Mail_PHPMailer();
		
		$phpMailer->IsHTML(true);
		$phpMailer->CharSet = "UTF-8";
		
		$phpMailer->WordWrap = 50;
		
		$phpMailer->IsSMTP();
		$phpMailer->Host = ""; // TODO introducir valor como atributos en el fichero config
		$phpMailer->Port = ""; // TODO introducir valor como atributos en el fichero config
		$phpMailer->SMTPAuth = true;
		
		// Para tareas de internacionalización
		
		$locale = Library_Manage_ResourceManager::getI18nData()->getLocale();
			
		$phpMailer->From = ""; // TODO introducir valor como atributos en el fichero config
		$phpMailer->FromName = ""; // TODO introducir valor como atributos en el fichero config
	
		$phpMailer->Username = ""; // TODO introducir valor como atributos en el fichero config
		$phpMailer->Password = ""; // TODO introducir valor como atributos en el fichero config
			
		$phpMailer->AddAddress($users[0]);
			
		for ($i = 1 ; $i < count($users) ; $i++)
		{
			$phpMailer->AddBCC($users[$i]);
		}
			
		return $phpMailer;
	}
}