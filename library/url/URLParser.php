<?php

class Library_URL_URLParser
{
	public static function parse($url, $urlData)
	{
		$i = 1;
		
		$urlTokens = explode("/", $url);
		
		if(isset($urlTokens[$i]))
		{
			$urlData->setModule($urlTokens[$i++]);
		}
		
		if(isset($urlTokens[$i]))
		{
			$urlData->setController($urlTokens[$i++]);
		}
		
		if(isset($urlTokens[$i]))
		{
			$urlData->setAction($urlTokens[$i++]);
		}
		
		for( ; $i < count($urlTokens) ; $i = $i + 2)
		{
			if(isset($urlTokens[$i]) && isset($urlTokens[$i + 1]))
			{
				$paramName =  $urlTokens[$i];
				$paramValue =  $urlTokens[$i + 1];
				
				$urlData->setParam($paramName, $paramValue);
			}
		}
		
		return $urlData;
	}
}