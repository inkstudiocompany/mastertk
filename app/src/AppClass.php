<?php

	namespace Application;

	class App
	{
		private $parameters = null;
		private static $instance = null;
		private static $router = null;

		public function __construct()
		{
			$this->parameters = [];
		}

		public static function getInstance()
    	{
        	if (null === static::$instance) {
            	$miclase = __CLASS__;
                self::$instance = new $miclase;
        	}

        	if (null === static::$router) {
            	static::$router = new \Slim\App();
        	}
        
        	return static::$instance;
    	}

    	public static function Router()
    	{
    		return static::$router;
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