<?php

class Application_Model_User_Item extends Library_Model_BaseItem
{
	private $id;
	private $name;
	private $password;
	private $role;
	private $email;
	private $married;
	private $childNum;
	
	public function __construct(array $options = null)
	{	
		$printer = new Application_Model_User_Printer();
		$printer->setElement($this);
		
		parent::__construct($options, $printer);
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
	public function setEmail($email)
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
	public function setMarried($married)
	{
	    $this->married = $married;
	}
	
	/**
	 * Devuelve el valor del atributo numChild.
	 *
	 * @return int
	 */
	public function getNumChild()
	{
	    return $this->numChild;
	}
	 
	/**
	 * Establece el valor del atributo numChild.
	 *
	 * @param int $numChild
	 */
	public function setNumChild($numChild)
	{
	    $this->numChild = $numChild;
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
	
}