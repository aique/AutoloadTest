<?php

class Library_Controller_ControllerDispatcher
{
	private $controller;
	
	public function __construct(Library_Controller_BaseController $controller)
	{
		$this->controller = $controller;
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
	*/
	public function dispatch()
	{
		try
		{
			$this->controller->init();
			$this->preDispatch($this->controller->getRequest());
			$this->applyLayout($this->applyView($this->doAction()));
			$this->postDispatch($this->controller->getRequest());
			$this->controller->end();
		}
		catch(Exception $exception)
		{
			Library_Manage_ResourceManager::getLogger()->logError($exception);
	
			$this->controller->getHelper()->redirect(new Library_Request_Request(Library_Request_Request::MODULE_DEFAULT_VALUE, "error", "error"));
		}
	}
	
	private function preDispatch(Library_Request_Request $request)
	{
		$currentAction = $request->__toString(); 
		
		foreach($this->controller->getPlugins() as $plugin)
		{
			$plugin->preDispatch($request);
			
			$this->checkPluginRedirection($request, $currentAction);
		}
	}
	
	private function postDispatch(Library_Request_Request $request)
	{
		$currentAction = $request->__toString();
		
		foreach($this->controller->getPlugins() as $plugin)
		{
			$plugin->postDispatch($request);
			
			$this->checkPluginRedirection($request, $currentAction);
		}
	}
	
	private function checkPluginRedirection($request, $currentAction)
	{
		$pluginActionRequested = $request->__toString();
		
		if($currentAction != $pluginActionRequested)
		{
			$this->controller->getHelper()->redirect($request);
			
			$this->endDispatch();
		}
	}
	
	public function endDispatch()
	{
		exit();
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
		$request = $this->controller->getRequest();
		
		$module = $request->getModule();
		$controller = $request->getController();
		$action = $request->getAction();
		
		$method = $action . "Action";
	
		if(method_exists($this->controller, $method))
		{
			Library_Manage_ResourceManager::getLogger()->logTrace("Llamando al action " . $method . " del controlador " . get_class($this));
				
			$this->controller->$method();
		}
		else
		{
			throw new Exception('No se ha encontrado el método ' . $method . ' dentro del controlador ' . get_class($this->controller) . '.');
		}
	}
	
	/**
	 * Aplica el fichero que renderiza la capa de la vista.
	 *
	 * @throws Exception
	 * 		Lanza una excepción cuando no existe el fichero que renderiza
	 * 		la capa de la vista.
	 */
	private function applyView()
	{
		$request = $this->controller->getRequest();
		
		$module = $request->getModule();
		$controller = $request->getController();
		$action = $request->getAction();
	
		if(empty($module))
		{
			$viewPath = PROJECT_PATH . "/application/views/scripts/" . $controller . "/" . $action . ".php";
		}
		else
		{
			$viewPath = PROJECT_PATH . "/application/modules/" . $module . "/views/scripts/" . $controller . "/" . $action . ".php";
		}
	
		if(file_exists($viewPath))
		{
			return Library_File_FileUtil::getFileContent($viewPath, $this->controller->getView());
		}
		else
		{
			return "";
		}
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
		$layout = PROJECT_PATH . "/application/layouts/scripts/" . $this->controller->getLayout() . ".php";
	
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
}