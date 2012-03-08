<?php

class Library_ACL_ACL
{
	private $resources;
	
	public function __construct()
	{
		$resources = array();
	}
	
	/**
	 * Devuelve el valor del atributo resources.
	 *
	 * @return array
	 */
	public function getResources()
	{
	    return $this->resources;
	}
	
	/**
	 * Establece el valor del atributo resources.
	 *
	 * @param array $resources
	 */
	public function setResources($resources)
	{
	    $this->resources = $resources;
	}
	
	public function addResource($resource, $role)
	{
		$this->resources[$resource][] = $role;
	}
	
	public function isAllowed($role, $resource)
	{
		foreach($this->resources as $resourceAllowed => $rolesAllowed)
		{
			if($resourceAllowed == $resource)
			{
				foreach($rolesAllowed as $roleAllowed)
				{
					if($roleAllowed == $role)
					{
						return true;
					}
				}
			}
		}
		
		return false;
	}
}