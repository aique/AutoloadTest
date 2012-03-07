<?php

class Library_Request_URLParser
{
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
			if(!empty($token))
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
					
				$i = $i + 2;
			}
		}
		
		return $request;
	}
}