<?php
	
	class Library_I18n_Date_Printers_DatePrinterEsES
	{
		public static function doPrint($date, $format)
		{
			switch($format)
			{
				case(Library_I18n_Date_DateFormat::SHORT):
					return self::printShortFormat($date);
					break;
				case(Library_I18n_Date_DateFormat::LONG):
					return self::printLongFormat($date);
					break;
				case(Library_I18n_Date_DateFormat::MONTH):
					return self::printMonthFormat($date);
					break;
				default:
					throw new Exception('El formato recibido es incorrecto, se ha encontrado ' . $format . '.');
			}
		}
		
		public static function getMonthName($monthNumber)
		{
			$monthName = "";
				
			switch($monthNumber)
			{
				case(1):
					$monthName = "Enero";
					break;
				case(2):
					$monthName = "Febrero";
					break;
				case(3):
					$monthName = "Marzo";
					break;
				case(4):
					$monthName = "Abril";
					break;
				case(5):
					$monthName = "Mayo";
					break;
				case(6):
					$monthName = "Junio";
					break;
				case(7):
					$monthName = "Julio";
					break;
				case(8):
					$monthName = "Agosto";
					break;
				case(9):
					$monthName = "Septiembre";
					break;
				case(10):
					$monthName = "Octubre";
					break;
				case(11):
					$monthName = "Noviembre";
					break;
				case(12):
					$monthName = "Diciembre";
					break;
				default:
					throw new Exception("El valor numérico del mes es incorrecto, recibido " . $monthName . ', debe ser un número entre 1 y 12.');
			}
			
			return $monthName;
				
		}
		
		private static function printShortFormat($date)
		{
			return $date->getDay() . '/' . $date->getMonth() . '/' . $date->getYear();
		}
		
		private static function printLongFormat($date)
		{
			return $date->getDay() . ' de ' . $date->getMonthName() . ' de ' . $date->getYear();
		}
		
		private static function printMonthFormat($date)
		{
			return $date->getMonthName() . ' ' . $date->getYear();
		}
		
	}

?>