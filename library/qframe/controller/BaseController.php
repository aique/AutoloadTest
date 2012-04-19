<?php

/**
 * Clase base de la cual heredarán los controladores utilizados por la
 * aplicación, la cual contiene el comportamiento y la información
 * común a todos ellos.
 * 
 * @package qframe
 * 
 * @subpackage controller
 * 
 * @author qinteractiva
 * 
 */
class Library_Qframe_Controller_BaseController
{
	/**
	 * Array que contendrá todos los elementos a los que accederá la capa de la vista.
	 * 
	 * @var array
	 */
	protected $view;
	
	protected $request;
	protected $layout;
	protected $helper;
	
	/**
	 * Variable que indica el contexto de la llamada al action y por tanto la manera
	 * en la que se devolverá la respuesta. Actualmente existen los siguientes valores:
	 * 
	 * <ul>
	 * <li>
	 * HTML (html): La respuesta del action se retornará en formato HTML,
	 * aplicando la vista y el layout sobre los datos obtenidos.
	 * </li>
	 * <li>
	 * JSON (json): La respuesta del action se retornará en formato JSON
	 * sobre los datos obtenidos.
	 * </li>
	 * </ul>
	 * 
	 * @var string
	 */
	protected $context;
	
	private $plugins;
	
	/**
	 * Objeto que encapsula la lógica de atención de la petición.
	 * 
	 * @var Library_Qframe_Controller_ControllerDispatcher
	 */
	private $dispatcher;
	
	public function __construct(Library_Qframe_Request_Request $request, $layout = Library_Qframe_Controller_ControllerConsts::DEFAULT_LAYOUT)
	{
		$this->request = $request;
		$this->layout = $layout;
		
		$this->view = array();
		$this->plugins = array();
		
		$this->helper = new Library_Qframe_Controller_ControllerHelper();
		$this->context = new Library_Qframe_Controller_Helper_ContextHelper(Library_Qframe_Controller_ControllerConsts::HTML_ACTION_CONTEXT);
		$this->dispatcher = new Library_Qframe_Controller_ControllerDispatcher($this);
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
	 * @return Library_Qframe_Request_Request
	 */
	public function getRequest()
	{
	    return $this->request;
	}
	 
	/**
	 * Establece el valor del atributo request.
	 *
	 * @param Library_Qframe_Request_Request $request
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
	 * @return Library_Qframe_Controller_ControllerHelper
	 */
	public function getHelper()
	{
	    return $this->helper;
	}
	 
	/**
	 * Establece el valor del atributo helper.
	 *
	 * @param Library_Qframe_Controller_ControllerHelper $helper
	 */
	public function setHelper($helper)
	{
	    $this->helper = $helper;
	}
	
	/**
	 * Devuelve el valor del atributo context.
	 *
	 * @return Library_Qframe_Controller_Helper_ContextHelper
	 */
	public function getContext()
	{
	    return $this->context;
	}
	 
	/**
	 * Establece el valor del atributo context.
	 *
	 * @param Library_Qframe_Controller_Helper_ContextHelper $context
	 */
	public function setContext($context)
	{
	    $this->context->setContext($context);
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
	
	/**
	 * Registra un nuevo plugin sobre el controlador.
	 * 
	 * @param Library_Qframe_Plugin_BasePlugin $plugin
	 */
	public function addPlugin(Library_Qframe_Plugin_BasePlugin $plugin)
	{
		$this->plugins[] = $plugin;
	}
	
	/**
	 * Devuelve el valor del atributo dispatcher.
	 *
	 * @return Library_Qframe_Controller_ControllerDispatcher
	 */
	public function getDispatcher()
	{
	    return $this->dispatcher;
	}
	 
	/**
	 * Establece el valor del atributo dispatcher.
	 *
	 * @param Library_Qframe_Controller_ControllerDispatcher $dispatcher
	 */
	public function setDispatcher($dispatcher)
	{
	    $this->dispatcher = $dispatcher;
	}
	
	/**
	 * Lleva a cabo la atención de la petición por el controlador, delegando
	 * en el atributo dispatcher.
	 */
	public function dispatch()
	{
		$this->dispatcher->dispatch();
	}
	
	/**
	 * Realiza las funciones de inicialización llevadas a cabo por el
	 * controlador.
	 * 
	 * Cada clase hija que así lo precise debe sobreescribir esté método
	 * estableciendo dentro de él las tareas de inicialización.
	 */
	public function init()
	{
	
	}
	
	/**
	 * Realiza las funciones necesarias una vez terminado el proceso de
	 * atención de la petición por parte del controlador. 
	 * 
	 * Cada clase hija que así lo precise debe sobreescribir esté método
	 * estableciendo dentro de él las tareas necesarias tras la atención
	 * de la petición.
	 */
	public function end()
	{
	
	}
	
}