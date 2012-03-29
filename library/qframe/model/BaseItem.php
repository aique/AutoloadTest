<?php

/**
 * Clase base de la que heredarán todos los Items utilizados por
 * la aplicación.
 * 
 * Los llamados Items se trata de clases que contienen tan sólo
 * los atributos de las entidades manejadas por la aplicación y
 * los métodos para acceder a ellos.
 * 
 * Existirá por tanto un Item por cada entidad, con los atributos
 * relacionados con la misma.
 * 
 * @package qframe
 * 
 * @subpackage model
 * 
 * @author qinteractiva
 *
 */
abstract class Library_Qframe_Model_BaseItem
{
	/**
	 * Atributo común a todos los Items, se trata del identificador
	 * con el que son almacenados en la base de datos.
	 * 
	 * @var int
	 */
	protected $id;
	
	/**
	 * Atributo común a todos los Items, se trata del objeto capaz
	 * de representar visualmente al objeto en sus diferentes variantes.
	 * 
	 * @var Library_Qframe_Printer_BasePrinter
	 */
	protected $printer;
	
	public function __construct(array $options = null, Library_Qframe_Model_ItemPrinter $printer)
	{
		if(is_array($options))
		{
			$this->setOptions($options);
		}
		
		$this->printer = $printer;
	}
	
	private function setOptions(array $options)
	{
		$methods = get_class_methods($this);
	
		foreach($options as $key => $value)
		{
			$method = 'set' . ucfirst($key);
	
			if(in_array($method, $methods))
			{
				$this->$method($value);
			}
		}
	
		return $this;
	}
	
	/**
	 * Permite establecer el valor de un atributo de la clase
	 * accediendo a ella como si fuera una propiedad pública,
	 * pero llamando a su método set correspondiente.
	 * 
	 * Esto permitiría llamar al método setId() de la siguiente
	 * manera:
	 * 
	 * $item->id = {valor}
	 * 
	 * Y equivaldrá a:
	 * 
	 * $item->setId({valor})
	 * 
	 * @param string $name
	 * 
	 * 		Nombre del atributo cuyo valor se modificará.
	 * 
	 * @param unknown_type $value
	 * 
	 * 		Nuevo valor que tomará el atributo especificado.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción en caso de quen no se encuentre
	 * 		el método set que corresponde al atributo especificado.
	 */
	public function __set($name, $value)
	{
		$method = 'set' . $name;
			
		if(!method_exists($this, $method))
		{
			throw new Exception('Se está accediendo a una propiedad no válida (' . $name . ') del objeto Application_Modules_Users_Model_User_Item.');
		}
		else
		{
			$this->$method($value);
		}
	}
	
	/**
	 * Permite acceder al valor de un atributo de la clase
	 * accediendo a ella como si fuera una propiedad pública,
	 * pero llamando a su método get correspondiente.
	 * 
	 * Esto permitiría llamar al método getId() de la siguiente
	 * manera:
	 * 
	 * $valorId = $item->id
	 * 
	 * Y equivaldrá a:
	 * 
	 * $valorId = $item->getId()
	 * 
	 * @param string $name
	 * 
	 * 		Nombre del atributo cuyo valor se obtendrá.
	 * 
	 * @return unknown_type
	 * 
	 * 		Valor del atributo especificado.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción en caso de quen no se encuentre
	 * 		el método set que corresponde al atributo especificado.
	 */
	public function __get($name)
	{
		$method = 'get' . $name;
			
		if(!method_exists($this, $method))
		{
			throw new Exception('Se está accediendo a una propiedad no válida (' . $name . ') del objeto Application_Modules_Users_Model_User_Item.');
		}
		else
		{
			return $this->$method();
		}
	}
	
	/**
	 * Devuelve el valor del atributo id.
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Establece el valor del atributo id.
	 *
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}
	
	/**
	 * Devuelve el valor del atributo printer.
	 *
	 * @return Library_Qframe_Printer_BasePrinter
	 */
	public function getPrinter()
	{
	    return $this->printer;
	}
	 
	/**
	 * Establece el valor del atributo printer.
	 *
	 * @param Library_Qframe_Printer_BasePrinter $printer
	 */
	public function setPrinter($printer)
	{
	    $this->printer = $printer;
	}
	
	/**
	 * Devuelve los atributos del Item como un array asociativo
	 * en el que las claves son el nombre de los mismos y los
	 * valores los establecidos para el propio objeto.
	 * 
	 * Así un Item Usuario con los siguientes atributos y valores:
	 * 
	 * <ul>
	 * <li>nombre: juan</li>
	 * <li>apellidos: pérez garcía</li>
	 * </ul>
	 * 
	 * Devolverá en la llamada de este método:
	 * 
	 * array[('nombre') => 'juan', ('apellidos') => 'pérez garcía']
	 * 
	 * Este método se emplea fundamentalmente para cubrir los campos
	 * de un formulario en base a la información de un objeto recuperado
	 * de la base de datos.
	 * 
	 * Así el formulario de actualización del Item Usuario será cubierto
	 * con los datos iniciales de manera sencilla una vez recuperado el
	 * usuario adecuado.
	 * 
	 * Este método ha de redefinirse en cada clase hija, aunque será
	 * idéntico para todas ellas, por lo que simplemente será necesario
	 * un copy-paste del mismo.
	 * 
	 * @return array
	 * 
	 * 		Array asociativo con los atributos del Item y sus valores.
	 * 
	 */
	public abstract function getAttributesAsArray();
	
	/**
	 * Establece los valores de los atributos del Item en base a un
	 * array asociativo recibido como parámetro, en el que las claves
	 * son el nombre de los mismos y los valores asociados a ellas
	 * los que se establecerán para cada uno de los atributos.
	 *
	 * Así un Item Usuario con los siguientes atributos y valores:
	 *
	 * <ul>
	 * <li>nombre</li>
	 * <li>apellidos</li>
	 * </ul>
	 *
	 * Al que sea invocado este método con los siguientes valores como
	 * parámetro:
	 *
	 * array[('nombre') => 'juan', ('apellidos') => 'pérez garcía']
	 * 
	 * Actualizará los valores de sus atributos a los contenidos en él.
	 *
	 * Este método se emplea fundamentalmente para cubrir los campos
	 * de un objeto en base a la información introducida por el usuario
	 * a través de un formulario
	 *
	 * Este método ha de redefinirse en cada clase hija, aunque será
	 * idéntico para todas ellas, por lo que simplemente será necesario
	 * un copy-paste del mismo.
	 *
	 * @param array $options
	 *
	 * 		Array asociativo con los atributos y los valores que se
	 * 		establecerán para el Item sobre el que es invocado este
	 * 		método.
	 *
	 */
	public abstract function setAttributesFromArray(array $options);
	
	/**
	 * Desvía la salida estándar del objeto a la salida
	 * estándar definida en su atributo printer.
	 * 
	 * @return string
	 * 
	 * 		Representación base del objeto, definida por
	 * 		su atributo printer.
	 */
	public function __toString()
	{
		return $this->printer->standardPrint();
	}
}