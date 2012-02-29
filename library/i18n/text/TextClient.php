<?php

	/**
	 * Clase cliente cuya función es atender las peticiones de tipo texto que
	 * el módulo de internacionalización I18n recibe.
	 */
	class Library_I18n_Text_TextClient
	{
		/**
		 * Método que devuelve un texto contenido en los ficheros de internacionalización
		 * a partir de la etiqueta asociada a él.
		 * 
		 * Según la localización proporcionada por el gestor de internacionalización extraerá
		 * el mencionado contenido de los ficheros correspondientes a uno y otro idioma.
		 * 
		 * @param string $textId
		 * 		Identificador del texto que se quiere extraer de los ficheros de internacionalización.
		 * 
		 * @param array $params
		 * 		Array de parámetros. Simplemente se trata de un array con cadenas, las cuales serán
		 * 		sustituidas por las interrogaciones que figuran en el texto rescatado. La posición
		 * 		vendrá determinada por el número que figura junto a la interrogación, que se utilizará
		 * 		como índice para acceder a la variable de este array de parámetros y sustituir su valor.
		 * 
		 * @throws Exception
		 * 		Se lanza una excepción alertando de que la localización no se encuentra dentro
		 * 		de las soportadas por el sistema, lo que implica que la ruta de los ficheros de
		 * 		internacionalización no se ha podido resolver ni por tanto extraer el texto
		 * 		solicitado.
		 */
		public static function getText($textId, $params = null)
		{
			$locale = Library_Manage_I18nManager::getI18nData()->getLocale();
			
			$textIdObj = new Library_I18n_Text_TextId($textId);
			
			if(Library_I18n_LocaleHelper::hasEnglishUSLocation($locale))
			{
				$text = self::getTextFromFile(Library_Manage_AppConfigManager::getVar("i18n.path") . Library_I18n_LocaleFileHelper::ENGLISH_LOCALE_FOLDER, $textIdObj);
			}
			elseif(Library_I18n_LocaleHelper::hasSpanishLocation($locale))
			{
				$text = self::getTextFromFile(Library_Manage_AppConfigManager::getVar("i18n.path") . Library_I18n_LocaleFileHelper::SPANISH_LOCALE_FOLDER, $textIdObj);
			}
			else
			{
				throw new Exception("Language not recognized");
			}
			
			return Library_I18n_Text_TextPrinter::doPrint($text, $params);
		}
		
		/**
		 * Obtiene el contenido que se encuentra en un fichero especificado por los parámetros
		 * que este método recibe. A diferencia de otros métodos de esta clase, retorna la totalidad
		 * del contenido del fichero.
		 * 
		 * Es útil cuando la salida que se quiere mostrar por pantalla es exactamente el contenido
		 * que se encuentra dentro del fichero que este método volcará a salida.
		 * 
		 * @param string $name
		 * 		Parámetro que indica el nombre del fichero al que este método accederá. A diferencia
		 * 		del resto de parámetros, es el único obligatorio que este método ha de recibir.
		 * 
		 * @param string $filePath
		 * 		Ubicación física dentro del servidor en la cual se encuentra el fichero al que este
		 * 		método accederá. Es un parámetro opcional, sin embargo es importante tener claro cuando
		 * 		ha de completarse.
		 * 
		 * 		Si se deja en blanco, por defecto el método buscará un fichero con el nombre indicado
		 * 		en el primer parámetro dentro del directorio por defecto de ficheros de internacionalización.
		 * 
		 * 		Este directorio se encuentra en la siguiente ruta:
		 * 		[pathFicherosInternacionalización] + locale + files
		 * 
		 * 		Si se completa, se puede especificar cualquier ruta dentro del servidor, permitiendo que
		 * 		este método actúe sobre un fichero sin importar su ubicación.
		 * 
		 * @param array $view
		 * 		Array de parámetros al que el fichero puede tener acceso mediante código PHP.
		 * 
		 * @throws Exception
		 * 		Se lanza una excepción alertando de que uno de los parámetros necesarios para que el método
		 * 		pueda operar correctamente no se ha recibido o bien su contenido es vacío. Se trata del
		 * 		primer parámetro que especifica el nombre del fichero.
		 */
		public static function getFileContent($name, $filePath = null, $view = null)
		{
			if(!isset($name) || empty($name))
			{
				throw new Exception("Parámetro requerido no recibido o vacío.");
			}
			
			if(!$filePath)
			{
				$locale = Library_Manage_I18nManager::getI18nData()->getLocale();
				$filePath = Library_Manage_AppConfigManager::getVar("i18n.path") . '/' . $locale . '/files/' . $name;
			}
			
			return Library_File_FileUtil::getFileContent($filePath, $view);
		}
		
		private static function getTextFromFile($path, $textId)
		{
			$ifm = new Library_I18n_I18nFileManager($path, $textId);
			return $ifm->getText($textId);
		}
		
	}

?>