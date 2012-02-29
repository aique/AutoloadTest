<?php

	class Library_I18n_Money_MoneyClient
	{
		public static function getMoney($money, $format)
		{
			$locale = Library_Manage_I18nManager::getI18nData()->getLocale();
			
			if(Library_I18n_LocaleHelper::hasEnglishUSLocation($locale))
			{
				$money = Library_I18n_Money_Printers_MoneyPrinterEnUS::doPrint($money, $format, $locale);
			}
			elseif(Library_I18n_LocaleHelper::hasSpanishLocation($locale))
			{
				$money = Library_I18n_Money_Printers_MoneyPrinterEsES::doPrint($money, $format, $locale);
			}
			else
			{
				exit("Language not recognized");
			}
			
			return $money;
		}
		
	}

?>