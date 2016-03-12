<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
	use Model\ORM\Proyecto as proyecto;

	class ProjectController extends ControllerBase
	{
		public function index()
		{
			return $this->render('proyectos/proyectos.html.twig');
		}

		public function listado()
		{
			$proyectos = proyecto::with('lider') -> get();
			return $this->render('proyectos/listado.html.twig', [
				'proyectos' => $proyectos
			]);
		}
		public function addForm()
		{
			return  $this->render('proyectos/agregar.html.twig',[
				'roles'=> RolController::listAll()]);
		}

        public function createNew($nomProyecto,$objProyecto,$inicioProyecto,$finProyecto,$productivoProyecto = 0,$idLider){
            $proyecto= new proyecto();
            $proyecto -> nomProyecto = $nomProyecto;
            $proyecto -> objProyecto = $objProyecto;
            $proyecto -> inicioProyecto = $inicioProyecto;
            $proyecto -> finProyecto = $finProyecto;
            $proyecto -> productivoProyecto = $productivoProyecto;
            $proyecto -> lider() -> associate($idLider);
            $proyecto-> save();
            return $proyecto;
        }

	}