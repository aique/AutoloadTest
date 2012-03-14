<?php

/**
 * Clase que gestiona el acceso a las distintas secciones de la aplicación,
 * permitiendo o denegando el paso en función de los permisos del usuario que
 * lo solicite.
 * 
 * @package library
 * 
 * @subpackage acl
 * 
 * @author qinteractiva
 *
 */
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
	
	/**
	 * Añade un nuevo recurso a los gestionados.
	 * 
	 * @param string $resource
	 * 
	 * 		Nombre del recurso que se va a añadir.
	 * 
	 * @param string $role
	 * 
	 * 		Nombre del rol necesario para acceder al recurso.
	 */
	public function addResource($resource, $role)
	{
		$this->resources[$resource][] = $role;
	}
	
	/**
	 * Permite identificar si un usuario con un rol determinado
	 * tiene acceso al recurso indicado.
	 * 
	 * @param string $role
	 * 
	 * 		Nombre del rol utilizado para determinar el permiso
	 * 		de acceso.
	 * 
	 * @param string $resource
	 * 
	 * 		Nombre del recurso sobre el que se evaluará el acceso.
	 * 
	 * @return boolean
	 * 
	 * 		Devuelve true en caso de que el rol se encuentre entre
	 * 		los permitidos por el recurso y false en caso contrario.
	 */
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