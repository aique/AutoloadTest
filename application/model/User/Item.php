<?php

class Application_Model_User_Item extends Library_Qframe_Model_BaseItem
{
	private $name;
	private $password;
	private $role;
	private $email;
	private $married;
	private $childNum;
	private $jobDesc;
	
	public function __construct(array $options = null)
	{	
		$printer = new Application_Model_User_Printer();
		$printer->setElement($this);
		
		parent::__construct($options, $printer);
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
	
	/**
	 * Devuelve el valor del atributo password.
	 *
	 * @return string
	 */
	public function getPassword()
	{
	    return $this->password;
	}
	 
	/**
	 * Establece el valor del atributo password.
	 *
	 * @param string $password
	 */
	public function setPassword($password)
	{
	    $this->password = $password;
	}
	
	/**
	 * Devuelve el valor del atributo role.
	 *
	 * @return string
	 */
	public function getRole()
	{
	    return $this->role;
	}
	 
	/**
	 * Establece el valor del atributo role.
	 *
	 * @param string $role
	 */
	public function setRole($role)
	{
	    $this->role = $role;
	}
	
	/**
	 * Devuelve el valor del atributo email.
	 *
	 * @return string
	 */
	public function getEmail()
	{
	    return $this->email;
	}
	 
	/**
	 * Establece el valor del atributo email.
	 *
	 * @param string $email
	 */
	public function setEmail($email = '')
	{
	    $this->email = $email;
	}
	
	/**
	 * Devuelve el valor del atributo married.
	 *
	 * @return boolean
	 */
	public function getMarried()
	{
	    return $this->married;
	}
	 
	/**
	 * Establece el valor del atributo married.
	 *
	 * @param boolean $married
	 */
	public function setMarried($married = 0)
	{
	    $this->married = $married;
	}
	
	/**
	 * Devuelve el valor del atributo childNum.
	 *
	 * @return int
	 */
	public function getChildNum()
	{
	    return $this->childNum;
	}
	 
	/**
	 * Establece el valor del atributo childNum.
	 *
	 * @param int $childNum
	 */
	public function setChildNum($childNum = 0)
	{
	    $this->childNum = $childNum;
	}
	
	/**
	 * Devuelve el valor del atributo jobDesc.
	 *
	 * @return string
	 */
	public function getJobDesc()
	{
	    return $this->jobDesc;
	}
	 
	/**
	 * Establece el valor del atributo jobDesc.
	 *
	 * @param string $jobDesc
	 */
	public function setJobDesc($jobDesc)
	{
	    $this->jobDesc = $jobDesc;
	}
	
	public function getAttributesAsArray()
	{
		$attributes = array();
	
		$vars = get_class_vars(get_class($this));
	
		foreach($vars as $key => $value)
		{
			$attributes[$key] = $this->__get($key);
		}
	
		return $attributes;
	}
	
	public function setAttributesFromArray(array $options)
	{
		$attributes = array_diff_assoc(get_class_vars(get_class($this)), get_class_vars(get_parent_class($this)));
	
		foreach($attributes as $key => $value)
		{
			$method = 'set' . ucfirst($key);
	
			if(key_exists($key, $options))
			{
				$this->$method($options[$key]);
			}
			else
			{
				$this->$method();
			}
		}
	}
	
}