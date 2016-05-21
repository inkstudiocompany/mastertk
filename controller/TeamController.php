<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
	use Model\ORM\Equipo as equipo;
	use Model\ORM\Proyecto as proyecto;


	class TeamController extends ControllerBase
	{
		public static function getByProject($idProject)
		{
			$equipos = equipo::with('lider') -> where('idProyecto','=',$idProject) ->get();
			return $equipos;
		}

		private static function getById($id)
		{
			return equipo::find($id);
		}

		public function index()
		{
			return $this->render('equipos/listado.html.twig',[
		           'equipos' => self::listAll()
				]);
		}
	
		public function listado()
		{
			$equipos = equipo::with('Proyecto')
			->leftjoin('UsuarioRolEquipo', 'Equipo.idEquipo', '=', 'UsuarioRolEquipo.idEquipo')
			->leftjoin('Usuario', 'UsuarioRolEquipo.idUsuario', '=', 'Usuario.idUsuario')
			->leftjoin('Rol', 'Rol.idRol', '=', 'UsuarioRolEquipo.idRol')
			->select ('Equipo.*', 'Usuario.nombreCompleto', 'Rol.nombreRol')
			-> get();
			
			return $this->render('equipos/listado.html.twig', [
				'equipos' => $equipos
			]);
		}

/*   		public function addForm()
		{
			return  $this->render('equipos/agregar.html.twig');
		}
*/
/*      public function createNew($nombreEquipo,$idProyecto,$idUsuario){
            $equipo = new equipo();
            $equipo -> nomEquipo = $nombreEquipo;
            
            $equipo = ProyectController::getById($idProyecto);
            //$equipo -> lider() -> associate($usuario);

            $equipo = UserController::getById($idUsuario);
            //$equipo -> lider() -> associate($usuario);
            
            $equipo -> save();
            return $proyecto;
        }
*/
       public function addForm()
        {
            return  $this->render('equipos/teamForm.html.twig', [
                'title' => 'Nuevo Equipo'
            ]);

        }

		public function editForm($id)
		{
			$equipo = Equipo::find($id);
			return $this->render('equipos/editar.html.twig', [
				'equipo' => $equipo,
				'title' => 'Editar Equipo',
				'proyectos' => proyecto::all()
			]);
		}


        public static function listAll()
        {
            return Equipo::all();
        }

        public function delete($id = 0) 
        {
            $equipo = Equipo::find($id);
            return $equipo->delete();
        }

        public static function Save($params)
        {
            $id = self::getInput($params, 'id');
            $idProyecto = self::getInput($params, 'idProyecto');
            $nombre = self::getInput($params, 'nombreEquipo');
            
            $equipo = new Equipo();

            if (false === empty($id) && $id !== false && (int) $id > 0) {
                $equipo = self::getById($id);
            }

            $equipo -> nombreEquipo = $nombre;
            $equipo -> save();
            return $equipo;
        }

		public function rename($nomEquipo, $idEquipo)
		{
			$result = false;
			$equipo = self::getById($idEquipo);
			if(!is_null($equipo)){
				$equipo -> nombreEquipo = $nomEquipo;
				$result = $equipo -> save();
			}
			return $result;
		}

        public function UsersByState($idEstado)
        {
            $response = false;



            return $response;
        }
	}