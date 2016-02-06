<?php
	
	namespace Application\Controller;

	class ControllerBase
	{

		protected static $instance = null;
		protected $twig = null;
		protected $loader = null;

		public function __construct()
		{
			$this->loader = new \Twig_Loader_Filesystem(BASE . 'src/views');
			$this->twig = new \Twig_Environment($this->loader, array(
		    	'cache' => BASE . 'web/cache/views',
			));
		}

    	public function render($template, $params = Array())
    	{

    		return $this->twig->render($template, $params);
    	}
	}