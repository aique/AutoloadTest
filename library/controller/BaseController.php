<?php

/**
 * Clase base que contiene el comportamiento común a todos los controladores
 * que posee la aplicación y de la cual han de heredar.
 */
class Library_Controller_BaseController
{
	protected $view;
	protected $request;
	protected $layout;
	protected $helper;
	
	private $plugins;
	
	private $dispatcher;
	
	const DEFAULT_LAYOUT = "layout";
	
	public function __construct(Library_Request_Request $request, $layout = self::DEFAULT_LAYOUT)
	{
		$this->request = $request;
		$this->layout = $layout;
		
		$this->view = array();
		$this->plugins = array();
		
		$this->helper = new Library_Controller_ControllerHelper();
		$this->dispatcher = new Library_Controller_ControllerDispatcher($this);
	}
	
	/**
	 * Devuelve el valor del atributo view.
	 *
	 * @return array
	 */
	public function getView()
	{
	    return $this->view;
	}
	 
	/**
	 * Establece el valor del atributo view.
	 *
	 * @param array $view
	 */
	public function setView($view)
	{
	    $this->view = $view;
	}
	
	/**
	 * Devuelve el valor del atributo request.
	 *
	 * @return Library_Request_Request
	 */
	public function getRequest()
	{
	    return $this->request;
	}
	 
	/**
	 * Establece el valor del atributo request.
	 *
	 * @param Library_Request_Request $request
	 */
	public function setRequest($request)
	{
	    $this->request = $request;
	}
	
	/**
	 * Devuelve el valor del atributo layout.
	 *
	 * @return string
	 */
	public function getLayout()
	{
	    return $this->layout;
	}
	 
	/**
	 * Establece el valor del atributo layout.
	 *
	 * @param string $layout
	 */
	public function setLayout($layout)
	{
	    $this->layout = $layout;
	}
	
	/**
	 * Devuelve el valor del atributo helper.
	 *
	 * @return Library_Controller_ControllerHelper
	 */
	public function getHelper()
	{
	    return $this->helper;
	}
	 
	/**
	 * Establece el valor del atributo helper.
	 *
	 * @param Library_Controller_ControllerHelper $helper
	 */
	public function setHelper($helper)
	{
	    $this->helper = $helper;
	}
	
	/**
	 * Devuelve el valor del atributo plugins.
	 *
	 * @return array
	 */
	public function getPlugins()
	{
	    return $this->plugins;
	}
	 
	/**
	 * Establece el valor del atributo plugins.
	 *
	 * @param array $plugins
	 */
	public function setPlugins($plugins)
	{
	    $this->plugins = $plugins;
	}
	
	public function addPlugin(Library_Plugin_BasePlugin $plugin)
	{
		$this->plugins[] = $plugin;
	}
	
	public function dispatch()
	{
		$this->dispatcher->dispatch();
	}
	
	/**
	* Realiza las funciones de inicialización pertinentes. Cada controlador
	* que hereda de esta clase base debe sobreescribir este método para
	* añadir las funciones que según el controlador sean necesarias antes
	* de atender la petición.
	*/
	public function init()
	{
	
	}
	
	/**
	* Realiza las funciones de finalización pertinentes. Cada controlador
	* que hereda de esta clase base debe sobreescribir este método para
	* añadir las funciones que según el controlador sean necesarias después
	* de atender la petición.
	*/
	public function end()
	{
	
	}
	
}