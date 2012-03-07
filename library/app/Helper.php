<?php

class Library_App_Helper
{
	public static function isModule($moduleName)
	{
		if(!empty($moduleName))
		{
			if(file_exists(PROJECT_PATH . "/application/modules/" . $moduleName))
			{
				return true;
			}
		}
		
		return false;
	}
}