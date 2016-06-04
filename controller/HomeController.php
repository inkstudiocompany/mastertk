<?php

	namespace Application\Controller;

	use Model\ORM\Proyecto;
    use Model\ORM\Usuario;

    class HomeController extends ControllerBase
	{
		public function index()
		{
            $usuario = SecurityController::user();
            $lidero = Proyecto::with(['equipos', 'lider'])
                ->join('Usuario', 'Usuario.idUsuario', '=', 'Proyecto.idLider')
                ->join('Rol', 'Rol.idRol', '=', 'Usuario.idRolPrincipal')
                ->where('Proyecto.idLider', '=', $usuario->id())
                ->select('Proyecto.*', 'Usuario.nombreCompleto', 'Rol.nombreRol');

            $misproyectos = Proyecto::with(['equipos', 'lider'])
                ->join('Equipo', 'Proyecto.idProyecto', '=', 'Equipo.idProyecto')
                ->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idEquipo', '=', 'Equipo.idEquipo')
                ->join('Rol', 'UsuarioRolEquipo.idRol', '=', 'Rol.idRol')
                ->join('Usuario', 'Usuario.idUsuario', '=', 'UsuarioRolEquipo.idUsuario')
                ->where('Usuario.idUsuario', '=', $usuario->id())
                ->select('Proyecto.*', 'Usuario.nombreCompleto', 'Rol.nombreRol')
                ->union($lidero)
                ->distinct()
                ->get();

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