<?php

class Library_Parsers_TranslationsFileParser
{
	public static function parse($filePath)
	{	
		$translations = array();
		
		$handler = fopen($filePath, 'r');
		
		while(!feof($handler))
		{
			$line = trim(fgets($handler));
				
			if(!empty($line))
			{
				$translation = self::getTranslation($line);
		
				if(isset($translation[0]) && isset($translation[1]))
				{
					$translations[$translation[0]] = $translation[1];
				}
			}
		}
		
		fclose($handler);
		
		return $translations;
	}
	
	private static function getTranslation($line)
	{
		$translation = array();
			
		$translation[0] = trim(substr($line, 0, stripos($line, '=')));
		
		$transInitValue = stripos($line, '"');
		$transEndValue = strrpos($line, '"');
	
		$translation[1] = substr($line, $transInitValue + 1, $transEndValue - $transInitValue - 1);
	
		return $translation;
	}
	
}