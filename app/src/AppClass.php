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
				'new_project' => '/proyectos/nuevo',
				'equipment' => '/equipos',
				'roles' => '/roles',
				'new_rol' => '/roles/nuevo',
                'edit_rol' => '/roles/editar/:id',
				'users' => '/usuarios',
				'new_user' => '/usuarios/nuevo',
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
				$configuration = [
					'settings' => [
						'displayErrorDetails' => true,
					],
				];
				$c = new \Slim\Container($configuration);
            	static::$router = new \Slim\App($c);
        	}
        
        	return static::$instance;
    	}

        public static function Router()
        {
            return static::$router;
        }

        public function redirect($route)
        {
            if (isset($this->routes[$route])) {
                header('Location: ' . $this->routes[$route]);
            }
        }

        public function path($path, $params=[], $absolute = false)
        {
            if(isset($this->routes[$path]) === false) return '/';

            $response = $this->routes[$path];

            if ($absolute === true) {
                $response = $this->get('host') . $this->routes[$path];
            }

            if ($params) {
                foreach ($params as $key => $value) {
                    $response = str_replace(':'.$key, $value, $response);
                }
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