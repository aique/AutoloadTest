<?php 

	/**
	 * Genera los ficheros de internacionalización a partir de el contenido
	 * de los documentos alojados en Google Docs a tal efecto.
	 */
	class I18nFileBuilder
	{
		/**
		 * @param unknown_type $i18nFile
		 * @param unknown_type $user
		 * @param unknown_type $pass
		 */
		public static function generateFiles($i18nFile, $user = false, $pass = false)
		{
			if($user && $pass)
			{
				self::downloadI18nFile($user, $pass, $i18nFile);
			} 
			
			self::generateI18nDirectories($i18nFile);
			self::generateI18nFiles($i18nFile);
		}
		
		/**
		 * @param unknown_type $user
		 * @param unknown_type $pass
		 * @param unknown_type $i18nFile
		 */
		private static function downloadI18nFile($user, $pass, $i18nFile)
		{
			$gdm = new GDataManager($user, $pass);
			
			$gdm->printWorksheet(INTERNALIZATION_SPREADSHEET_KEY,
							     INTERNALIZATION_LOCAL_I18N_PATH,
								 SpreadsheetConst::I18N_SPREADSHEET_PREFIX);
		}
		
		/**
		 * @param unknown_type $i18nFile
		 */
		private static function generateI18nDirectories($i18nFile)
		{
			self::makeDir(INTERNALIZATION_DOWNLOAD_LOCAL_FILES_PATH . "/" . date("Y-m-d"));
			
			$handler = fopen($i18nFile, "r");
			
			$data = fgetcsv($handler, 0, ";", "\n");
			
			foreach($data as $cell)
			{
				if(LocaleHelper::hasEnglishUSLocation($cell))
				{
					self::makeDir(INTERNALIZATION_DOWNLOAD_LOCAL_FILES_PATH . "/" . date("Y-m-d") . "/" . LocaleHelper::ENGLISH_ABB_LOCATION);
				}
				elseif(LocaleHelper::hasSpanishLocation($cell))
				{
					self::makeDir(INTERNALIZATION_DOWNLOAD_LOCAL_FILES_PATH . "/" . date("Y-m-d") . "/" . LocaleHelper::SPANISH_ABB_LOCATION);
				}
			}
			
			fclose($handler);
			
		}
		
		/**
		 * @param unknown_type $i18nFile
		 */
		private static function generateI18nFiles($i18nFile)
		{
			ini_set('auto_detect_line_endings', true);
			
			$handler = fopen($i18nFile, "r");
			
			$data = fgetcsv($handler, 0, ";", "\n");
			
			for($i = 0 ; $i < count($data) ; $i++)
			{
				if(LocaleHelper::hasEnglishUSLocation($data[$i]))
				{	
					self::putText($handler, INTERNALIZATION_DOWNLOAD_LOCAL_FILES_PATH . "/" . date("Y-m-d") . LocaleFileHelper::TEXT_ENGLISH_LOCALE_FOLDER, $i);
				}
				elseif(LocaleHelper::hasSpanishLocation($data[$i]))
				{
					self::putText($handler, INTERNALIZATION_DOWNLOAD_LOCAL_FILES_PATH . "/" . date("Y-m-d") . LocaleFileHelper::TEXT_SPANISH_LOCALE_FOLDER, $i);
				}
			}
			
			fclose($handler);
		}
		
		/**
		 * @param unknown_type $handler
		 * @param unknown_type $path
		 * @param unknown_type $currentColumn
		 */
		private static function putText($handler, $path, $currentColumn)
		{
			$originalPosition = ftell($handler);
			
			$oldPagePath = null;
			
			$ifm = new I18nFileManager();
			
			while(($data = fgetcsv($handler, 0, ";", "\n")) != false)
			{
				if($data[0] != "Etiqueta")
				{
					$label = strtolower($data[0]);
					$labelInfo = explode("_", $label);
					
					$typePath = $path . "/" . $labelInfo[0];
					$mediaPath = $typePath . "/" . $labelInfo[1];
					$pagePath = $mediaPath . "/" . $labelInfo[2] . ".txt";
					
					if($oldPagePath != $pagePath)
					{
						self::makeDir($typePath);
						self::makeDir($mediaPath);
						unlink($pagePath);
							
						$oldPagePath = $pagePath;
					}
					
					$ifm->putText($pagePath, $label, $data[$currentColumn]);
				}
			}
			
			fseek($handler, $originalPosition);
		}
		
		/**
		 * @param unknown_type $dir
		 * @param unknown_type $remove
		 */
		private static function makeDir($dir, $remove = false)
		{
			if($remove)
			{
				FileUtil::removeDirectoryTree($dir);
			}

			if(!file_exists($dir))
			{
				mkdir($dir);	
			}
		}
		
	}

?>