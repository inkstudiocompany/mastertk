<?php

    namespace Application;

    use Application\Routes;
    use Application\Controller\MessageController as Message;
    
    class App
    {
        private $parameters = null;
        private static $instance = null;
        private static $router = null;
        private $routes = null;
        private $message = null;


		public function __construct()
		{
			$this->parameters = [];
			$this->routes = Routes::getRoutes();
            $this->message = new Message();
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
                        'debug' => true,

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
                    //$response = str_replace(':'.$key, $value, $response);
                    $response = str_replace('[/{'.$key.'}]', '/' . $value, $response);
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
            $param = $this->parameters[$parameter];

            if ($this->isJson($param) === true) {
                $param = json_decode($param, true);
            }

            return $param;
        }

        private function isJson($string)
        {
            return json_decode($string) !== NULL;
        }

        /**
        *
        */
        public function set($parameter, $value)
        {
            $this->parameters[$parameter] = $value;
        }

        public function Message()
        {
            return $this->message;
        }

        public function config()
        {
            var_dump($this->parameters);
        }
    }