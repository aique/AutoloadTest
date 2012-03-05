<?php

/**
 * Clase base que contiene el comportamiento común a todos los controladores
 * que posee la aplicación y de la cual han de heredar.
 */
class Library_Controller_BaseController
{
	protected $view;
	protected $url;
	protected $layout;
	protected $helper;
	
	const DEFAULT_LAYOUT = "layout";
	
	public function __construct($url, $layout = self::DEFAULT_LAYOUT)
	{
		$this->url = $url;
		$this->layout = $layout;
		
		$view = array();
		$this->helper = new Library_Controller_ControllerHelper();
	}
	
	/**
	 * Único método público de esta clase y por tanto de todos los
	 * controladores que posee la aplicación. Se utiliza para atender
	 * una petición realizada por el usuario a un action concreto.
	 * 
	 * Cuando la aplicación recibe una petición, contruye el controlador
	 * que ha de atenderla en base a su URL y llama a este método, el cual
	 * realiza las tareas de inicialización necesarias, llama al action
	 * correspondiente, aplica el layout definido para el controlador y
	 * realiza las tareas de finalización.
	 * 
	 * @param Library_URL_URL $url
	 * 		Objeto de tipo Library_URL_URL que contiene la información
	 * 		acerca de la URL introducida por el usuario en su petición.
	 */
	public function dispatch()
	{
		try
		{	
			$this->init();
			$this->applyLayout($this->applyView($this->doAction()));
			$this->end();
		}
		catch(Exception $exception)
		{
			Library_Manage_ResourceManager::getLogger()->logError($exception);
			
			$this->view["error"] = $exception->getMessage();
			
			$this->helper->redirect(new Library_URL_URL(Library_URL_URL::MODULE_DEFAULT_VALUE, "error", "error"));
		}
	}
	
	/**
	 * Realiza las funciones de inicialización pertinentes. Cada controlador
	 * que hereda de esta clase base debe sobreescribir este método para
	 * añadir las funciones que según el controlador sean necesarias antes
	 * de atender la petición.
	 */
	protected function init()
	{
		
	}
	
	/**
	 * Analiza la URL recibida en la petición y determina el action dentro
	 * del controlador que debe encargarse de responder.
	 * 
	 * @throws Exception
	 * 		Lanza una excepción cuando no existe el action encargado de atender
	 * 		la petición.
	 * 
	 * @return array
	 * 		Array recibido como parámetro con los valores definitivos que
	 * 		recibirá la capa de la vista.
	 */
	private function doAction()
	{
		
		$module = $this->url->getModule();
		$controller = $this->url->getController();
		$action = $this->url->getAction();
		
		$method = $action . "Action";
		
		if(method_exists($this, $method))
		{
			Library_Manage_ResourceManager::getLogger()->logTrace("Llamando al action " . $method . " del controlador " . get_class($this), Library_Log_LogMessageType::TRACE);
			
			$this->view = $this->$method($this->view);
		}
		else
		{
			throw new Exception('No se ha encontrado el método ' . $method . ' dentro del controlador ' . get_class($this) . '.');
		}
	}
	
	/**
	 * Aplica el fichero que renderiza la capa de la vista.
	 * 
	 * @param Library_URL_URL $url
	 * 		Objeto de tipo Library_URL_URL que contiene la información
	 * 		acerca de la URL introducida por el usuario en su petición.
	 * 
	 * @param array $view
	 * 		Array en el que se almacenarán los valores que se desean pasar
	 * 		desde el action encargado de atender la petición hacia la capa
	 * 		de la vista.
	 * 
	 * @throws Exception
	 * 		Lanza una excepción cuando no existe el fichero que renderiza
	 * 		la capa de la vista.
	 */
	private function applyView()
	{
		$module = $this->url->getModule();
		$controller = $this->url->getController();
		$action = $this->url->getAction();
		
		if(empty($module))
		{
			$viewPath = PROJECT_PATH . "/application/views/scripts/" . $controller . "/" . $action . ".php";
		}
		else
		{
			$viewPath = PROJECT_PATH . "/application/modules/" . $module . "/views/scripts/" . $controller . "/" . $action . ".php";
		}
		
		if(!file_exists($viewPath))
		{
			throw new Exception("Se intenta aplicar una vista que no existe: " . $viewPath . ".");
		}
		
		return Library_File_FileUtil::getFileContent($viewPath, $this->view);
	}
	
	/**
	 * Aplica el layout definido para el controlador. Si no se especifica
	 * nada, se aplicará el layout por defecto, el cual se encuentra dentro
	 * del directorio de layouts bajo el nombre de layout.
	 * 
	 * @param string $content
	 * 		Cadena de texto con el contenido principal que ha de mostrarse
	 * 		dentro del layout.
	 */
	private function applyLayout($content)
	{
		$layout = PROJECT_PATH . "/application/layouts/scripts/" . $this->layout . ".php";
		
		if(file_exists($layout))
		{
			include $layout;
		}
		else
		{
			$layout = include PROJECT_PATH . "/application/layouts/scripts/" . self::DEFAULT_LAYOUT . ".php";
			
			if(file_exists($layout))
			{
				include $layout;
			}
		}
	}
	
	/**
	 * Realiza las funciones de finalización pertinentes. Cada controlador
	 * que hereda de esta clase base debe sobreescribir este método para
	 * añadir las funciones que según el controlador sean necesarias después
	 * de atender la petición.
	 */
	protected function end()
	{
		
	}
}