<?php

class Library_File_FileUtil
{
	public static function getFilesFromFolder($folder)
	{
		return array_diff(scandir($folder), array('..', '.'));
	}
	
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
	
	public static function removeDirectoryTree($dir)
	{
		if(file_exists($dir))
		{
			$dhandle = opendir($dir);
	
			if($dhandle)
			{
				while(($fname = readdir($dhandle)) !== false)
				{
					if(is_dir( "{$dir}/{$fname}" ))
					{
						if(($fname != '.') && ($fname != '..'))
						{
							self::removeDirectoryTree("$dir/$fname");
						}
					}
					else
					{
						unlink("{$dir}/{$fname}");
					}
				}
				closedir($dhandle);
			}
	
			rmdir($dir);
		}
	}
}