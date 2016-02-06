<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;

	class HomeController extends ControllerBase
	{
		public function index()
		{
			echo $this->render('home/home.php.twig');
		}
	}