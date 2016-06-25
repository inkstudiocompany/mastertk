<?php

	namespace Application\Controller;

	use Model\ORM\Proyecto;
    use Model\ORM\Usuario;

    class HomeController extends ControllerBase
	{
		public function index()
		{
            $usuario = SecurityController::user();
			$misproyectos = Proyecto::with(['lider.rolPrincipal'])
				->leftJoin('Equipo', function($join){
					$join->on('Equipo.idProyecto', '=', 'Proyecto.idProyecto')
						->where ('Equipo.estado','=',1);
					})
				->leftJoin('UsuarioRolEquipo', function($join){
					$join->on('Equipo.idEquipo', '=', 'UsuarioRolEquipo.idEquipo')
						->where ('UsuarioRolEquipo.activo','=',1);
				})
				->where('UsuarioRolEquipo.idUsuario', '=', $usuario->id())
				->orWhere('Proyecto.idLider', '=', $usuario->id())
				->distinct('Proyecto.*')
				->select('Proyecto.*')
				-> get();

            $mistickets = Proyecto::with(['equipos', 'lider'])
                ->join('Item', 'Proyecto.idProyecto', '=', 'Item.idProyecto')
                ->join('Estado', 'Item.estadoActual', '=', 'Estado.idEstado')
                ->join('TipoItem', 'Item.idTipoItem', '=', 'TipoItem.idTipoItem')
                ->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idUsuarioRolEquipo', '=', 'Item.responsable')
                ->join('Usuario', 'Usuario.idUsuario', '=', 'UsuarioRolEquipo.idUsuario')
                ->where('Usuario.idUsuario', '=', $usuario->id())
                ->get();


            $usuarioORM = new Usuario();
            $history = $usuarioORM->history($usuario->id())->get();

			echo $this->render('home/home.php.twig', [
                'misproyectos'  => $misproyectos,
                'mistickets'    => $mistickets,
                'history'       => $history
            ]);
		}

		public static function getById($id)
		{
			throw new Exception('Not implemented');
		}
	}