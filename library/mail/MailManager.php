<?php

class Library_Mail_MailManager
{
	public static function sendMail($receivers, $subject, $args, $template)
	{
		$phpMailer = Library_Mail_MailHelper::createPHPMailerObject($receivers);
			
		$phpMailer->Subject = $subject;
		
		$templateFile = Library_Manage_ResourceManager::getConfig()->getVar("mail.templatesPath") . $template . ".php";
		
		$phpMailer->Body = Library_File_FileUtil::getFileContent($templateFile, $args);

		if(Library_Manage_ResourceManager::getConfig()->getVar("mail.logMailContent"))
		{	
			Library_Manage_ResourceManager::getLogger()->logMail($phpMailer->Body, $template);
				
			return 1;
		}
		else
		{
			return $phpMailer->Send();
		}
	}
}