<?php

	namespace Application\Controller;

	use Model\ORM\Proyecto;
    use Model\ORM\Usuario;

    class HomeController extends ControllerBase
	{
		public function index()
		{
            $usuario = SecurityController::user();
            $misproyectos = Proyecto::with(['equipos', 'lider'])
                ->leftJoin('Equipo', 'Proyecto.idProyecto', '=', 'Equipo.idProyecto')
                ->leftJoin('UsuarioRolEquipo', 'UsuarioRolEquipo.idEquipo', '=', 'Equipo.idEquipo')
                ->leftJoin('Rol', 'UsuarioRolEquipo.idRol', '=', 'Rol.idRol')
                ->leftJoin('Usuario', 'Usuario.idUsuario', '=', 'UsuarioRolEquipo.idUsuario')
                ->where('Usuario.idUsuario', '=', $usuario->id())
                ->orWhere(function($query, $usuario)
                {
                    $usuario = SecurityController::user();
                    $query->where('Proyecto.idLider', '=', $usuario->id());
                })->distinct()->get();

            $mistickets = Proyecto::with(['equipos', 'lider'])
                ->join('Item', 'Proyecto.idProyecto', '=', 'Item.idProyecto')
                ->join('Estado', 'Item.estadoActual', '=', 'Estado.idEstado')
                ->join('TipoItem', 'Item.idTipoItem', '=', 'TipoItem.idTipoItem')
                ->join('Usuario', 'Usuario.idUsuario', '=', 'Item.responsable')
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