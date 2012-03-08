<?php

/**
 * Clase que lee un fichero de traducciones y parsea su contenido para
 * devolver en un array los valores encontrados en él.
 * 
 * @author qinteractiva
 *
 */
class Library_Parsers_TranslationsFileParser
{
	/**
	 * Parsea el contenido de un fichero de traducciones y devuelve un array
	 * con los valores encontrados.
	 * 
	 * @param string $filePath
	 * 
	 * 		Cadena de texto con la ubicación donde se encuentra el fichero
	 * 		de traducciones.
	 * 
	 * @return array
	 * 
	 * 		Array asociativo con las traducciones encontradas. Cada clave será
	 * 		un literal encontrado, y el valor asociado a ella será el contenido
	 * 		que se debe sustituir por él en la vista. 
	 */
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
	
	/**
	 * Identifica los valores que se encuentran en una línea del fichero
	 * de traducciones, las cuales tienen el siguiente formato:
	 * 
	 * - [literal] = "[contenido]"
	 * 
	 * @param string $line
	 * 
	 * 		Cadena de texto con el valor de una de las línea del fichero
	 * 		de traducciones.
	 */
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