<?php

/**
 * Clase encargada de gestionar la entrada de datos a aplicación.
 * 
 * Se encargará de ofrecer los métodos necesarios para comunicarse
 * con el usuario a través de la información enviada tanto por GET
 * como por POST.
 * 
 * A su vez también deberá eliminar auqella información introducida
 * por el usuario que pueda poner en peligro la seguridad de la aplicación.
 * 
 * @package qframe
 * 
 * @subpackage manage
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Manage_InputManager
{
	const GET = "GET";
	const POST = "POST";
	
	/**
	 * Devuelve el valor de un parámetro enviado a la aplicación a
	 * partir de su nombre y del método utilizado para realizar este
	 * envío.
	 * 
	 * @param string $name
	 * 
	 * 		Nombre del parámetro cuyo valor se desea obtener.
	 * 
	 * @param string $method
	 * 
	 * 		Nombre del método utilizado en el envío del parámetro.
	 * 
	 * @return
	 * 
	 * 		Cadena de texto con el valor del parámetro solicitado.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción en caso de que el segundo parámetro
	 * 		que identifica el medio por el que se le ha enviado el
	 * 		parámetro no sea ni GET ni POST.
	 */
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
	
	/**
	 * Devuelve en un array asociativo todos los parámetros enviados
	 * a través de un determinado método de envío.
	 * 
	 * @param string $method
	 * 
	 * 		Método de envío del cual se quieren obtener todos los parámetros.
	 * 
	 * @return array
	 * 
	 * 		Array asociativo con los parámetros solicitados.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción en caso de que el segundo parámetro
	 * 		que identifica el medio por el que se le ha enviado el
	 * 		parámetro no sea ni GET ni POST.
	 */
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
	
	/**
	 * Comprueba si se ha realizado una petición GET sobre la aplicación.
	 * 
	 * @return boolean
	 * 
	 * 		Devuelve true en caso que se haya enviado información
	 * 		a la aplicación mediante GET y false en caso contrario.
	 */
	public static function isGET()
	{
		return count($_GET) > 0;
	}
	
	/**
	* Comprueba si se ha realizado una petición POST sobre la aplicación.
	*
	* @return boolean
	*
	* 		Devuelve true en caso que se haya enviado información
	* 		a la aplicación mediante POST y false en caso contrario.
	*/
	public static function isPOST()
	{
		return count($_POST) > 0;
	}
	
	private static function clean($param)
	{
		$param = utf8_decode($param);
		$param = strip_tags($param);
		$param = htmlentities($param, ENT_COMPAT, 'UTF-8');
		$param = stripslashes($param);
		
		return $param;
	}
		
}