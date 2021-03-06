<?php

	namespace Application\Controller;

	use Model\ORM\Proyecto as proyecto;


	class ProjectController extends ControllerBase
	{


		private static function getById($id)
		{
			return proyecto::find($id);
		}

		/*public static function delete($id)
		{

			$proyecto = self::getById($id);
			return $proyecto -> delete();

		}*/

		public function index()
		{
            return $this->render('proyectos/proyectos.html.twig');
		}

		public function listado()
		{
			$proyectos = proyecto::with(['lider','items']) -> get();
			return $this->render('proyectos/listado.html.twig', [
				'proyectos' => $proyectos
			]);

		}
		public function addForm()
		{
			return  $this->render('proyectos/agregar.html.twig',[
				'roles'=> RolController::listAll()]);
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

			if(empty($idProyecto)){
				$proyecto -> equipos() -> saveMany ($params['equipos']);
				$proyecto -> tipoItem() -> saveMany($params['tiposItem']);
				$proyecto -> tipoItem -> each(function($tipoItem){
					$tipoItem -> estados() -> saveMany( TipoItemController::getIntialsStates());
				});
			}
			return $proyecto;
		}

		public function editTeamForm($id)
		{
			$proyecto = proyecto::with('lider') -> find($id);
			$usuarios = UserController::listWithRolAll();
			$roles = RolController::listAll();
			return $this->render('proyectos/editar-equipos.html.twig', [
				'proyecto' => $proyecto, 'usuarios' =>$usuarios,
				'roles'=>$roles
			]);

		}

		public function editItemTypeForm($id)
		{
			$proyecto = self::getById($id);
			$tiposItem = TipoItemController::getByProject($id);
			$equipos = TeamController::getByProject($id);

			return $this->render('proyectos/editar-tipos-item.html.twig', [
				'proyecto' => $proyecto,
				'tiposItem' =>$tiposItem,
				'equipos' => $equipos
			]);
		}

        public function detalle ($id) {
            $response = proyecto::with([
                    'lider',
                    'equipos.usuarioRolEquipo.usuario',
                    'items.status',
                    'items.asignado.usuario'
                ]) -> find($id);

            if (true === is_null($response)) {
                $response = new Response();
                return $response->withRedirect($this->container->path('list_project_teams', true));
            }

            return $this->render('misproyectos/detalle.html.twig', [
                'proyecto'  => $response
            ]);
        }

        public function delete($id = 0)
        {
            $proyecto = proyecto::find($id);
            $proyecto->estado = 0;
            return $proyecto->save();
        }

		public static function getProjectStats($id)
		{
			$tipoitems = proyecto::with(['equiposActivos',
				'tipoItemActivos',
				'cuentaItemsPorEstado',
				'equiposActivos.cuentaItemsAsignados',
				'tipoItemActivos.cuentaTickets'])
				-> where ('idProyecto','=',$id)
				-> get();
			return $tipoitems;
		}
	}