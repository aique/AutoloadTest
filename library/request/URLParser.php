<?php

/**
 * Clase que parsea una URL.
 * 
 * @author qinteractiva
 * 
 */
class Library_Request_URLParser
{
	/**
	 * Parsea una URL y devuelve un objeto de tipo Library_Request_Request con
	 * sus atributos debidamente establecidos en función de la información
	 * encontrada en ella.
	 * 
	 * @param string $url
	 * 
	 * 		Cadena de texto con la URL que se va a parsear.
	 * 
	 * 		El formato que el parseador reconoce es el siguiente:
	 * 
	 * 		- http://[nombreApp]/[modulo]/[controlador]/[action]/[param1]/[val1]/[param2]/[val2]/...
	 * 
	 * @return Library_Request_Request
	 * 
	 * 		Objeto de tipo Library_Request_Request con los atributos establecidos
	 * 		en función de la URL parseada.
	 */
	public static function parse($url)
	{
		$request = new Library_Request_Request();
		
		$i = 1;
		
		$moduleSetted = $controllerSetted = $actionSetted = false;
		
		$urlTokens = explode("/", $url);
		
		// Procesa la URL hasta llegar al action, donde termina el bucle
		// que identifica la URL para comenzar con el bucle que identifica
		// los parámetros.
		
		foreach($urlTokens as $token)
		{
			if(!empty($token) && !self::isGETParam($token))
			{
				if(Library_App_Helper::isModule($token) && !$moduleSetted)
				{
					$request->setModule($token);
					$moduleSetted = true;
					$i++;
				}
				else
				{
					if(!$controllerSetted)
					{
						$request->setController($token);
						$controllerSetted = true;
						$i++;
					}
					else
					{
						if(!$actionSetted)
						{
							$request->setAction($token);
							$actionSetted = true;
							$i++;
						}
						else
						{
							break;
						}
					}
				}
			}
		}
		
		while($i < count($urlTokens))
		{
			if(isset($urlTokens[$i]) && isset($urlTokens[$i + 1]))
			{		
				$paramName = $urlTokens[$i];
				$paramValue = $urlTokens[$i + 1];
				$request->setParam($paramName, $paramValue);
			}
			
			$i = $i + 2;
		}
		
		return $request;
	}
	
	private static function isGETParam($token)
	{
		return substr($token, 0, 1) == "?";
	}
}