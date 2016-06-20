<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
	use Model\ORM\Equipo as equipo;
	use Model\ORM\Proyecto as proyecto;
	use Model\ORM\Usuario;
	use Model\ORM\UsuarioRolEquipo;


	class TeamController extends ControllerBase
	{
		public static function getByProject($idProject)
		{
/*			error_log(equipo::with('borrable')
				->where('idProyecto','=',$idProject)
				->leftJoin('UsuarioRolEquipo', function($join){
					$join->on('Equipo.idEquipo', '=', 'UsuarioRolEquipo.idEquipo')
						->where ('UsuarioRolEquipo.esLider','=',1)
						->where ('UsuarioRolEquipo.activo','=',1);
				})
				->leftjoin('Usuario', 'UsuarioRolEquipo.idUsuario', '=', 'Usuario.idUsuario')
				->select ('Equipo.*', 'Usuario.nombreCompleto')
				->toSql());*/


			$equipos = equipo::with(['cuentaItemsAsignados'])
				-> where('idProyecto','=',$idProject)
				-> where('Equipo.estado',1)
				->leftJoin('UsuarioRolEquipo', function($join){
					$join->on('Equipo.idEquipo', '=', 'UsuarioRolEquipo.idEquipo')
						->where ('UsuarioRolEquipo.esLider','=',1)
						->where ('UsuarioRolEquipo.activo','=',1);
				})
				->leftjoin('Usuario', 'UsuarioRolEquipo.idUsuario', '=', 'Usuario.idUsuario')
				->select ('Equipo.*', 'Usuario.nombreCompleto')
				->get();
			return $equipos;
		}

		private static function getById($id)
		{
			return equipo::find($id);
		}

		public static function updateUsuariosRolEquipo($idEquipo, $items)
		{
			UsuarioRolEquipo::where('idEquipo', '=',$idEquipo) -> update(['activo'=> 0]);

			foreach($items as $usuarioRolEquipo){
				$usuarioRolEquipoDB =  UsuarioRolEquipo::buscarUsuarioEquipo( $usuarioRolEquipo -> idUsuario, $usuarioRolEquipo ->idEquipo)	-> first();
				if(!is_null($usuarioRolEquipoDB)){
					$usuarioRolEquipoDB -> activo = 1;
					$usuarioRolEquipoDB -> save();
				}else{
					$usuarioRolEquipo ->save();
				}
			}

		}

		public static function listarUsuariosRolEquipo($idEquipo)
		{
			$usuariosRolEquipo = UsuarioRolEquipo::with(array(
				'usuario'=>function($query){$query->select('idUsuario','nombreCompleto');},
				'rol' =>function($query){$query->select('idRol','nombreRol');}
			))
				->where('idEquipo','=',$idEquipo)
				->where ('activo','=', 1)
				->get();
			return $usuariosRolEquipo;
		}

		public static function updateLiderEquipo($idEquipo, $idUsuarioRolEquipo)
		{
			var_dump($idEquipo);
			UsuarioRolEquipo::where('idEquipo', '=',$idEquipo) -> update(['esLider'=> 0]);
			UsuarioRolEquipo::where('idUsuarioRolEquipo', '=',$idUsuarioRolEquipo)-> update(['esLider'=> 1]);
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
			-> where('Equipo.estado',1)
			->leftjoin('UsuarioRolEquipo', 'Equipo.idEquipo', '=', 'UsuarioRolEquipo.idEquipo')
			->leftjoin('Usuario', 'UsuarioRolEquipo.idUsuario', '=', 'Usuario.idUsuario')
			->leftjoin('Rol', 'Rol.idRol', '=', 'UsuarioRolEquipo.idRol')
			->select ('Equipo.*', 'Usuario.nombreCompleto', 'Rol.nombreRol')
			-> get();
			
			return $this->render('equipos/listado.html.twig', [
				'equipos' => $equipos
			]);
		}

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
            return Equipo::where('estado',1);
        }

        public function delete($id = 0) 
        {
            $equipo = Equipo::find($id);
			$equipo -> estado = 0;
			return 	$equipo -> save();
            //return $equipo->delete();
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
			$equipo ->proyecto() ->associate($idProyecto);
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