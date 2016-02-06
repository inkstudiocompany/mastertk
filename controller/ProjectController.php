<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;

	class ProjectController extends ControllerBase
	{
		public function index()
		{
			echo $this->render('proyectos/proyectos.html.twig');
		}

		public function listado()
		{
			echo $this->render('proyectos/listado.html.twig');
		}
	}