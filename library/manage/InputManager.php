<?php
	
class Library_Manage_InputManager
{
	const GET = "GET";
	const POST = "POST";
	
	public static function getParam($name, $method = self::POST)
	{
		$param = false;
		
		if($method == self::GET)
		{
			if(isset($_GET[$name]))
			{
				$param = self::clean($_GET[$name]);
			}
		}
		elseif($method == self::POST)
		{
			if(isset($_POST[$name]))
			{
				$param = self::clean($_POST[$name]);
			}
		}
		else
		{
			throw new Exception("Se intenta acceder a una variable con entrada " . $method . ". Sólo GET y POST están permitidas.");
		}
			
		return $param;
	}
	
	public static function getParams($method = self::POST)
	{
		$params = array();
		
		if($method == self::GET)
		{
			$params = $_GET;
		}
		elseif($method == self::POST)
		{
			$params = $_POST;
		}
		else
		{
			throw new Exception("Se intenta acceder a las variables con entrada " . $method . ". Sólo GET y POST están permitidas.");
		}
		
		return $params;
	}
	
	public static function isGET()
	{
		return count($_GET) > 0;
	}
	
	public static function isPOST()
	{
		return count($_POST) > 0;
	}
	
	private static function clean($param)
	{
		$param = utf8_decode($_GET[$name]);
		$param = strip_tags($param);
		$param = htmlentities($param, ENT_COMPAT, 'UTF-8');
		$param = stripslashes($param);
		
		return $param;
	}
		
}