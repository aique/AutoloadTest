<?php

abstract class Library_Model_BaseItem
{
	protected $id;
	
	protected $printer;
	
	public function __construct(array $options = null, Library_Printer_BasePrinter $printer)
	{
		if(is_array($options))
		{
			$this->setOptions($options);
		}
		
		$this->printer = $printer;
	}
	
	/**
	* Returns the id value.
	*
	* @return int
	*/
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * Set the id value.
	 *
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
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
	 * Devuelve el valor del atributo printer.
	 *
	 * @return Library_Printer_BasePrinter
	 */
	public function getPrinter()
	{
	    return $this->printer;
	}
	 
	/**
	 * Establece el valor del atributo printer.
	 *
	 * @param Library_Printer_BasePrinter $printer
	 */
	public function setPrinter($printer)
	{
	    $this->printer = $printer;
	}
	
	public abstract function getAttributesAsArray();
	
	public abstract function setAttributesFromArray(array $options);
	
	public function __toString()
	{
		return $this->printer->standardPrint();
	}
}