<?php
	
	namespace Application\Controller;

	use Application\App;

	abstract class ControllerBase
	{

		protected static $instance  = null;
		protected $twig             = null;
		protected $loader           = null;
		protected $container        = null;

		public function __construct()
		{
			$this->loader = new \Twig_Loader_Filesystem(BASE . 'src/views');
			$this->twig = new \Twig_Environment($this->loader, array(
		    	'cache' => BASE . 'web/cache/views',
		    	'debug' => true,
			));
			$this->twig->addExtension(new \Twig_Extension_Debug());

			global $app;
			/** @var App container */
			$this->container = $app;
		}

		public function render($template, $params = Array())
    	{
    		global $app;
    		$params['app'] = $app;

    		return $this->twig->render($template, $params);
    	}

		public function getParameter($name)
		{
			global $app;
			return $app->get($name);
		}

        /**
         * hasParameter
         *
         * Valida que exista el parametro en las lista
         *
         * @param $parameters
         * @param $name
         * @return bool
         */
    public static function hasParameter($parameters, $name)
    {
        return isset($parameters[$name]) === true
            //&& empty($parameters[$name]) === false
            && is_null($parameters[$name]) === false;
    }

    public static function getInput($parameters, $name)
    {
        $response = false;
        if(self::hasParameter($parameters, $name) === true) {
            $response = $parameters[$name];
        }
        return $response;
    }
	}