<?php

	class Library_Qframe_I18n_Date_DateClient
	{
		public static function getDate($date, $format)
		{
			$locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
			
			if(Library_Qframe_I18n_LocaleHelper::hasEnglishUSLocation($locale))
			{
				$date = Library_Qframe_I18n_Date_Printers_DatePrinterEnUS::doPrint($date, $format);
			}
			elseif(Library_Qframe_I18n_LocaleHelper::hasSpanishLocation($locale))
			{
				$date = Library_Qframe_I18n_Date_Printers_DatePrinterEsES::doPrint($date, $format);
			}
			else
			{
				throw new Exception("Lenguaje no reconocido.");
			}
			
			return $date;
		}
		
		public static function getMonthName($monthNumber)
		{
			$locale = Library_Qframe_Manage_ResourceManager::getI18nData()->getLocale();
				
			if(LocaleHelper::hasEnglishUSLocation($locale))
			{
				$monthName = DatePrinter_enUS::getMonthName($monthNumber);
			}
			elseif(LocaleHelper::hasSpanishLocation($locale))
			{
				$monthName = DatePrinter_esES::getMonthName($monthNumber);
			}
			else
			{
				throw new Exception("Lenguaje no reconocido.");
			}
				
			return $monthName;
		}
		
	}

?>