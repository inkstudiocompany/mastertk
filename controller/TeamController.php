<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
	use Model\ORM\Equipo as equipo;

	class TeamController extends ControllerBase
	{
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

	}