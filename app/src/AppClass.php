<?php

	namespace Application;

	class App
	{
		private $parameters = null;
		private static $instance = null;

		public function __construct()
		{
			$this->parameters = [];
		}

		public static function getInstance()
    	{
        	if (null === static::$instance) {
            	static::$instance = new static();
        	}
        
        	return static::$instance;
    	}

		/**
		* get
		*
		* Obtiene el parametro
		*/
		public function get($parameter)
		{
			return $this->parameters[$parameter];
		}

		/**
		*
		*/
		public function set($parameter, $value)
		{
			$this->parameters[$parameter] = $value;
		}

		public function config()
		{
			var_dump($this->parameters);
		}
	}