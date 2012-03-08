<?php

	class Library_I18n_Text_TextId
	{
		private $media, $controller, $action, $id;
		
		public function __construct($textId)
		{
			$tokens = explode("_", $textId, 4);
			
			if(count($tokens) >= 4)
			{
				$this->media = strtolower($tokens[0]);
				$this->controller = strtolower($tokens[1]);
				$this->action = strtolower($tokens[2]);
				$this->id = strtolower($tokens[3]);
			}
			else
			{
				throw new Exception("Invalid TextId format: " . $textId);
			}
		}
		
		public function getMedia()
		{
			return $this->media;
		}
		
		public function getController()
		{
			return $this->controller;
		}
		
		public function getAction()
		{
			return $this->action;
		}
		
		public function getId()
		{
			return $this->id;
		}
		
	}

?>