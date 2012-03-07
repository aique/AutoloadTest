<?php

/**
 * Clase que es capaz de parsear el contenido de los ficheros de configuración
 * y devolver los valores que figuran en él como un array.
 * 
 * Estos ficheros tienen el siguiente formato:
 * 
 * 		nombreVariableSeparadaPorPuntos = "[valorVariable]"
 */
class Library_Util_ConfigFileParser
{
	public static function parse($filePath)
	{		
		$values = array();
		
		$currentEnvironment = null;
		
		$handler = fopen($filePath, 'r');
		
		while(!feof($handler))
		{
			$line = trim(fgets($handler));
				
			if(!self::isComment($line) && !empty($line))
			{
				if(self::isEnvironmentDefinition($line))
				{
					$currentEnvironment = self::setEnvironmentValue($line);
				}
				else
				{
					$value = self::getAttributeValue($line);
		
					if($value != null)
					{
						$values[$currentEnvironment][$value[0]] = $value[1];
					}
				}
					
			}
		}
		
		fclose($handler);
		
		return $values;
	}
	
	private static function getAttributeValue($line)
	{
		$values = array();
			
		$varEndPos = stripos($line, '=');
			
		$values[0] = trim(substr($line, 0, $varEndPos));
		
		$values[1] = self::renderValue(trim(substr($line, $varEndPos + 1, strlen($line))));
		
		return $values;
	}
	
	private static function renderValue($value)
	{
		$renderedValue = '';
		 
		$tokens = explode('+', $value);
		
		foreach($tokens as $token)
		{
			$token = trim($token);
			
			if(self::isPHPVar($token))
			{
				$renderedValue .= self::getPHPVarValue($token);
			}
			elseif(self::isTextValue($token))
			{
				$renderedValue .= self::getTextValue($token);
			}
			else
			{
				throw new Exception('No se ha podido renderizar el valor del atributo desde el parser del fichero de configuración: Error de formato en el valor: ' . $value . '.');
			}
		}
		
		return $renderedValue;
	}
	
	private static function setEnvironmentValue($line)
	{
		$envInitValue = stripos($line, '[');
		$envEndValue = strrpos($line, ']');
		
		return trim(substr($line, $envInitValue + 1, $envEndValue - 1));
	}
	
	private static function isPHPVar($token)
	{
		return preg_match('/{*}/', $token);
	}
	
	private static function getPHPVarValue($token)
	{
		$varInitPos = stripos($token, '{') + 1;
		$varEndPos = strrpos($token, '}');
		
		return constant(substr($token, $varInitPos, $varEndPos - $varInitPos));
	}
	
	private function isTextValue($token)
	{
		return preg_match('/"*"/', $token);
	}
	
	private function getTextValue($token)
	{
		$valInitPos = stripos($token, "\"") + 1;
		$valEndPos = strrpos($token, "\"");
		
		return substr($token, $valInitPos, $valEndPos - $valInitPos);
	}
	
	private static function isComment($line)
	{
		return preg_match('/^\/\/*/', $line);
	}
	
	private static function isEnvironmentDefinition($line)
	{
		return preg_match('/\[*\]/', $line);
	}
	
}