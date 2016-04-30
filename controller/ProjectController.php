<?php

	namespace Application\Controller;

	use Model\ORM\Proyecto as proyecto;



	class ProjectController extends ControllerBase
	{


		private static function getById($id)
		{
			return proyecto::find($id);
		}

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

        public function createNew($nomProyecto,$objProyecto,$inicioProyecto,$finProyecto,$productivoProyecto = 0,$idLider, $equipos, $tiposItem){
            $proyecto= new Proyecto();
            $proyecto -> nomProyecto = $nomProyecto;
            $proyecto -> objProyecto = $objProyecto;
            $proyecto -> inicioProyecto = $inicioProyecto;
            $proyecto -> finProyecto = $finProyecto;
            $proyecto -> productivoProyecto = $productivoProyecto;
            $proyecto -> lider() -> associate($idLider);
			$proyecto->save();
			$proyecto -> equipos() -> saveMany ($equipos);
			$proyecto -> tipoItem() -> saveMany($tiposItem);
        }

		public function editForm($id)
		{
			$proyecto = proyecto::with('lider') -> find($id);
			return $this->render('proyectos/editar.html.twig', [
				'proyecto' => $proyecto
			]);
		}

		public static function save($params)
		{
			$idProyecto = self::getInput($params,'idProyecto');
			$idLider = self::getInput($params,'idLider');
			$proyecto = new proyecto();
			if(!empty($idProyecto)){
				$proyecto = self::getById($idProyecto);
			}
			$proyecto -> nomProyecto = self::getInput($params,'nomProyecto');
			$proyecto -> objProyecto= self::getInput($params,'objProyecto');
			$proyecto -> inicioProyecto= self::getInput($params,'inicioProyecto');
			$proyecto -> finProyecto= self::getInput($params,'finProyecto');
			$proyecto -> productivoProyecto = self::getInput($params,'productivoProyecto');
			$proyecto -> lider() -> associate($idLider);
			$proyecto->save();
			if(is_null($idProyecto)){
				$proyecto -> equipos() -> saveMany ($params['equipos']);
				$proyecto -> tipoItem() -> saveMany($params['tiposItem']);
			}
			return $proyecto;
		}

		public function editTeamForm($id)
		{
			$proyecto = proyecto::with('lider') -> find($id);
			return $this->render('proyectos/editar-equipos.html.twig', [
				'proyecto' => $proyecto
			]);

		}

	}