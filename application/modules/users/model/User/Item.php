<?php

class Application_Modules_Users_Model_User_Item
{
	private $id;
	private $name;
	
	public function __construct(array $options = null)
	{
		if (is_array($options))
		{
			$this->setOptions($options);
		}
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
			throw new Exception('Invalid property');
		}
		 
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		 
		if(!method_exists($this, $method))
		{
			throw new Exception('Invalid property');
		}
		 
		return $this->$method();
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
	
	/**
	 * Returns the name value.
	 *
	 * @return string
	 */
	public function getName()
	{
	    return $this->name;
	}
	 
	/**
	 * Set the name value.
	 *
	 * @param string $name
	 */
	public function setName($name)
	{
	    $this->name = $name;
	}
	
}