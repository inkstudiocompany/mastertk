<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;

	class RolController extends ControllerBase
	{
		public function index()
		{
			echo $this->render('roles/listado.html.twig');
		}

		// public function listado()
		// {
		// 	echo $this->render('proyectos/listado.html.twig');
		// }
	}