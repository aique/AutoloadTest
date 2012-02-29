<?php
	
class Library_Manage_InputManager
{
	public static function getParamGET($name)
	{
		$param = "";
			
		if(isset($_GET[$name]))
		{
			$param = utf8_decode($_GET[$name]);
			$param = strip_tags($param);
			$param = htmlentities($param, ENT_COMPAT, 'UTF-8');
			$param = stripslashes($param);			
		}
			
		return $param;
	}
		
	public static function getParamPOST($name)
	{
		$param = "";
		
		if(isset($_POST[$name]))
		{
			$param = utf8_decode($_POST[$name]);
			$param = strip_tags($param);
			$param = htmlentities($param, ENT_COMPAT, 'UTF-8');
			$param = stripslashes($param);
		}
			
		return $param;
	}
		
}