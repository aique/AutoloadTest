<?php

class Library_File_FileUtil
{
	public static function getFileContent($template, $view)
	{
		if(is_file($template))
		{
			ob_start();
			include $template;
			$contents = ob_get_contents();
			ob_end_clean();
			return $contents;
		}
		else
		{
			return false;
		}
	}
}