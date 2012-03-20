<?php

	/**
	 * Clase que gestiona todo lo relacionado con la adaptación de la aplicación
	 * a los diferentes idiomas soportados.
	 */
	class Library_Qframe_I18n_I18nData
	{
		private $locale;
		private $supportedLocations = null;
		
		private static $instance = null;
		
		public function __construct()
		{
			$this->supportedLocations = array();
			
			array_push($this->supportedLocations, new Library_Qframe_i18n_Locale(Library_Qframe_I18n_LocaleConst::SPANISH_LOCATION,
															 			  Library_Qframe_I18n_LocaleConst::SPANISH_ABB_LOCATION,
															 			  Library_Qframe_I18n_LocaleConst::SPAIN_UNI_LOCATION));
			
			array_push($this->supportedLocations, new Library_Qframe_i18n_Locale(Library_Qframe_I18n_LocaleConst::ENGLISH_LOCATION,
															 			  Library_Qframe_I18n_LocaleConst::ENGLISH_ABB_LOCATION,
															 			  Library_Qframe_I18n_LocaleConst::ENGLAND_UNI_LOCATION));
			
			$this->locale = self::recognizeLanguage();
		}
		
		/**
		 * 
		 */
		public function getLocale()
		{
			return $this->locale;
		}
		
		/**
		 * @param unknown_type $locale
		 */
		public function setLocale($locale)
		{
			$this->locale = $locale;
		}
		
		/**
		 * 
		 */
		public function getSupportedLocations()
		{
			return $this->supportedLocations;
		}
		
		/**
		 * 
		 */
		public function getUniversalLocale()
		{
			return LocaleHelper::getUniversalLocation($this->locale);
		}
		
		/**
		 * 
		 */
		private static function recognizeLanguage()
		{
			if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
			{
				$language = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
					
				$language = strtolower($language[0]);
				
				if(Library_Qframe_I18n_LocaleHelper::hasEnglishUSLocation($language))
				{
					return Library_Qframe_I18n_LocaleConst::ENGLISH_ABB_LOCATION;
				}
				elseif(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($language))
				{
					return Library_Qframe_I18n_LocaleConst::SPANISH_ABB_LOCATION;
				}
				else
				{
					return Library_Qframe_Manage_ResourceManager::getConfig()->getVar("i18n.defaultLang");
				}
			}
			else
			{
				return Library_Qframe_Manage_ResourceManager::getConfig()->getVar("i18n.defaultLang");
			}
		}
	}
?>