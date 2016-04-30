<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
	use Model\ORM\Equipo as equipo;


	class TeamController extends ControllerBase
	{
		public static function getByProject($idProject)
		{
			$equipos = equipo::with('lider') -> where('idProyecto','=',$idProject) ->get();
			return$equipos;
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
			->join('UsuarioRolEquipo', 'Equipo.idEquipo', '=', 'UsuarioRolEquipo.idEquipo')
			->join('Usuario', 'UsuarioRolEquipo.idUsuario', '=', 'Usuario.idUsuario')
			-> get();
			
			return $this->render('equipos/listado.html.twig', [
				'equipos' => $equipos
			]);
		}

   		public function addForm()
		{
			return  $this->render('equipos/agregar.html.twig');
		}

        public function createNew($nombreEquipo,$idProyecto,$idUsuario){
            $equipo = new equipo();
            $equipo -> nomEquipo = $nombreEquipo;
            
            $equipo = ProyectController::getById($idProyecto);
            //$equipo -> lider() -> associate($usuario);

            $equipo = UserController::getById($idUsuario);
            //$equipo -> lider() -> associate($usuario);
            
            $equipo -> save();
            return $proyecto;
        }

        public static function listAll()
        {
            return Equipo::all();
        }

        public function delete($id = 0) 
        {
            $rol = Equipo::find($id);
            return $equipo->delete();
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

	}