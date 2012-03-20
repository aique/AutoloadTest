<?php

/**
 * Contiene la lógica común a todos los controladores que llevará a cabo
 * el proceso de atención de peticiones.
 * 
 * @package qframe
 * 
 * @subpackage controller
 * 
 * @author qinteractiva
 *
 */
class Library_Qframe_Controller_ControllerDispatcher
{
	private $controller;
	
	public function __construct(Library_Qframe_Controller_BaseController $controller)
	{
		$this->controller = $controller;
	}
	
	/**
	 * Atiende una petición recibida por la aplicación. Los pasos que se
	 * llevan a cabo son los sigueintes:
	 * 
	 * <ul>
	 * <li>Realiza una llamada al método init() para llevar a cabo las tareas de inicialización.</li>
	 * <li>Lleva a cabo un bucle sobre todos los plugins asociados a él ejecutando sus métodos preDispatch().</li>
	 * <li>Realiza una llamada al action correspondiente, aplicando la vista a su respuesta y posteriormente el layout.</li>
	 * <li>Lleva a cabo un bucle sobre todos los plugins asociados a él ejecutando sus métodos postDispatch().</li>
	 * <li>Realiza una llamada al método init() para llevar a cabo las tareas de finalización.</li>
	 * </ul>
	 */
	public function dispatch()
	{
		try
		{
			$this->controller->init();
			$this->preDispatch($this->controller->getRequest());
			$this->doAction();
			$this->postDispatch($this->controller->getRequest());
			$this->controller->end();
			
			$this->applyLayout($this->applyView());
		}
		catch(Exception $exception)
		{
			Library_Qframe_Manage_ResourceManager::getLogger()->logError($exception);
	
			$this->controller->getHelper()->redirect(new Library_Qframe_Request_Request(Library_Qframe_Request_Request::MODULE_DEFAULT_VALUE, "error", "error"));
		}
	}
	
	/**
	 * Realiza un bucle sobre todos los plugins asociados al controlador
	 * ejecutando sus métodos preDispatch().
	 * 
	 * Este método recibe el objeto petición como parámetro, ya que existe
	 * la opción de poder hacer una redirección dentro del plugin en caso
	 * de que así se considere oportuno.
	 * 
	 * @param Library_Qframe_Request_Request $request
	 * 
	 * 		Petición que se está tratando en el momento de ejecutar los métodos
	 * 		preDispatch() de los plugins.
	 */
	private function preDispatch(Library_Qframe_Request_Request $request)
	{
		$currentAction = $request->__toString(); 
		
		foreach($this->controller->getPlugins() as $plugin)
		{
			$plugin->preDispatch($request);
			
			$this->checkPluginRedirection($request, $currentAction);
		}
	}
	
	/**
	 * Realiza un bucle sobre todos los plugins asociados al controlador
	 * ejecutando sus métodos postDispatch().
	 *
	 * Este método recibe el objeto petición como parámetro, ya que existe
	 * la opción de poder hacer una redirección dentro del plugin en caso
	 * de que así se considere oportuno.
	 *
	 * @param Library_Qframe_Request_Request $request
	 *
	 * 		Petición que se está tratando en el momento de ejecutar los métodos
	 * 		postDispatch() de los plugins.
	 */
	private function postDispatch(Library_Qframe_Request_Request $request)
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
	 * Analiza la URL asociada a la petición y determina que action del
	 * controlador será el encargado de responder.
	 * 
	 * @throws Exception
	 * 
	 * 		Lanza una excepción cuando no existe dentro del controlador el
	 * 		action que por la URL asociada a la petición debería encargarse
	 * 		de responder.
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
			Library_Qframe_Manage_ResourceManager::getLogger()->logTrace("Llamando al action " . $method . " del controlador " . get_class($this));
				
			$this->controller->$method();
		}
		else
		{
			throw new Exception('No se ha encontrado el método ' . $method . ' dentro del controlador ' . get_class($this->controller) . '.');
		}
	}
	
	/**
	 * Aplica el fichero que renderiza la capa de la vista y devuelve su
	 * contenido.
	 * 
	 * @return string
	 * 
	 * 		Cadena de texto con el código HTML que se mostrará en el navegador,
	 * 		a falta de aplicar el layout sobre él.
	 *
	 * @throws Exception
	 * 
	 * 		Lanza una excepción cuando no encuentra el fichero que renderiza
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
			return Library_Qframe_File_FileUtil::getFileContent($viewPath, $this->controller->getView());
		}
		else
		{
			return "";
		}
	}
	
	/**
	 * Aplica el layout definido para el controlador.
	 * 
	 * Si no se ha especificado ninguno, se aplicará el layout por defecto,
	 * el cual se encuentra dentro del directorio de layouts bajo el nombre
	 * de layout.
	 *
	 * @param string $content
	 * 
	 * 		Cadena de texto con el código HTML que se mostrará en el navegador,
	 * 		a falta de aplicar el layout sobre él.
	 */
	private function applyLayout($content)
	{
		$view = $this->controller->getView();
		
		$view['content'] = $content;
		
		$layout = PROJECT_PATH . "/application/layouts/scripts/" . $this->controller->getLayout() . ".php";
	
		if(file_exists($layout))
		{
			echo Library_Qframe_File_FileUtil::getFileContent($layout, $view);
		}
		else
		{
			$layout = include PROJECT_PATH . "/application/layouts/scripts/" . self::DEFAULT_LAYOUT . ".php";
				
			if(file_exists($layout))
			{
				echo Library_Qframe_File_FileUtil::getFileContent($layout, $view);
			}
		}
	}
}