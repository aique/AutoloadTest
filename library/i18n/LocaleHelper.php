<?php

	class Library_I18n_LocaleHelper
	{	
		public static function hasEnglishUSLocation($location)
		{
			return $location == Library_I18n_LocaleConst::ENGLISH_LOCATION ||
				   $location == Library_I18n_LocaleConst::ENGLISH_ABB_LOCATION ||
				   $location == Library_I18n_LocaleConst::ENGLAND_UNI_LOCATION ||
				   $location == Library_I18n_LocaleConst::US_UNI_LOCATION;
		}
		
		public static function hasSpanishLocation($location)
		{
			return $location == Library_I18n_LocaleConst::SPANISH_LOCATION ||
				   $location == Library_I18n_LocaleConst::SPANISH_ABB_LOCATION ||
				   $location == Library_I18n_LocaleConst::SPAIN_UNI_LOCATION ||
				   $location == Library_I18n_LocaleConst::CATALUÑA_LOCATION ||
				   $location == Library_I18n_LocaleConst::CATALUÑA_ABB_LOCATION ||
				   $location == Library_I18n_LocaleConst::PAISVASCO_LOCATION ||
				   $location == Library_I18n_LocaleConst::PAISVASCO_ABB_LOCATION ||
				   $location == Library_I18n_LocaleConst::GALICIA_LOCATION ||
				   $location == Library_I18n_LocaleConst::GALICIA_ABB_LOCATION;
		}
		
		public static function validateLocation($location)
		{
			return $location == self::SPANISH_ABB_LOCATION || $location == self::ENGLISH_ABB_LOCATION;
		}
		
		public static function getUniversalLocation($location)
		{
			switch($location)
			{
				case(self::ENGLISH_ABB_LOCATION):
					return Library_I18n_LocaleConst::US_UNI_LOCATION;
					break;
				case(self::SPANISH_ABB_LOCATION):
					return Library_I18n_LocaleConst::SPAIN_UNI_LOCATION;
					break;
				default:
					return DEFAULT_LANGUAGE;
			}
		}
		
	}

?>