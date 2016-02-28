<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
	use Model\ORM\Proyecto as proyecto;

	class ProjectController extends ControllerBase implements EntityController
	{
		public function index()
		{
			return $this->render('proyectos/proyectos.html.twig');
		}

		public function listado()
		{
			return $this->render('proyectos/listado.html.twig', [
				'proyectos' => proyecto::listAll()
			]);
		}

		public static function getById($id)
		{
			return proyecto::find($id);
		}
	}