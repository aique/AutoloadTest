<?php

class Library_Qframe_Mail_MailManager
{
	public static function sendMail($receivers, $subject, $args, $template)
	{
		$phpMailer = Library_Qframe_Mail_MailHelper::createPHPMailerObject($receivers);
			
		$phpMailer->Subject = $subject;
		
		$templateFile = Library_Qframe_Manage_ResourceManager::getConfig()->getVar("mail.templatesPath") . $template . ".php";
		
		$phpMailer->Body = Library_Qframe_File_FileUtil::getFileContent($templateFile, $args);

		if(Library_Qframe_Manage_ResourceManager::getConfig()->getVar("mail.logMailContent"))
		{	
			Library_Qframe_Manage_ResourceManager::getLogger()->logMail($phpMailer->Body, $template);
				
			return 1;
		}
		else
		{
			return $phpMailer->Send();
		}
	}
}