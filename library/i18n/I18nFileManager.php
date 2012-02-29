<?php

	/**
	 * 
	 */
	class Library_I18n_I18nFileManager
	{
		private $fileContents;
		
		public function __construct($path = null, $textId = null)
		{
			if($textId)
			{
				$file = $path . "/" . $textId->getMedia() . "/" . $textId->getController() . ".txt";
			}
			else
			{
				$file = $path;
			}
			
			if($path)
			{
				$handler = fopen($file, "r");
				$this->fileContents = fread($handler, filesize($file));
				fclose($handler);
			}
		}
		
		/**
		 * 
		 * @param unknown_type $textIdObj
		 * @return mixed
		 */
		public function getText($textIdObj)
		{
			$lines = explode("\n", $this->fileContents);
			
			$text = "";
			
			foreach($lines as $line)
			{	
				if(!empty($line))
				{
					$separatorPosition = stripos($line, "=");
					
					$textId = trim(substr($line, 0, $separatorPosition));
					
					$textInitContent = stripos($line, "\"") + 1;
					$textEndContent = strrpos($line, "\"");
					
					$textContent = trim(substr($line, $textInitContent, $textEndContent - $textInitContent));
					
					$currentTextId = new Library_I18n_Text_TextId($textId);
					
					if($currentTextId->getId() == $textIdObj->getId())
					{
						return $textContent;
					}
				}
			}
		}
		
		/**
		 * 
		 * @param unknown_type $path
		 * @param unknown_type $label
		 * @param unknown_type $value
		 */
		public function putText($path, $label, $value)
		{
			$handler = fopen($path, "a");
			fwrite($handler, $label . ":" . "\"" . $value . "\"\n");
			fclose($handler);
		}
		
	}
	
?>