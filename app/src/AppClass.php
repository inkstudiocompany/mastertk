<?php

	namespace Application;

	class App
	{
		private $parameters = null;
		private static $instance = null;
		private static $router = null;
		private $routes = null;

		public function __construct()
		{
			$this->parameters = [];
			$this->routes = [
				'homepage' => '/home',
				'my_projects' => '/misproyectos',
				'my_tickets' => '/mistickets',
				'history' => '/historial',
				'admin_project' => '/proyectos',
				'equipment' => '/equipos',
				'roles' => '/roles',
				'new_rol' => '/roles/nuevo',
				'users' => '/usuarios',
				'type_item' => '/tipoitem',
				'states' => '/estados',
				'workflow' => '/workflow',
			];
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

    	public function path($path, $absolute = false)
    	{
    		if(isset($this->routes[$path]) === false) return '/';

    		$response = $this->routes[$path];

    		if ($absolute === true) {
    			$response = $this->get('host') . $this->routes[$path];
    		}

    		return $response;
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