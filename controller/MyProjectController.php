<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
	use Model\ORM\Proyecto ;
    use Application\Controller\SecurityController;

	class MyProjectController extends ControllerBase
	{

		public function proyects()
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

			return $this->render('misproyectos/listado.html.twig', [
				'misproyectos' => $misproyectos
			]);

		}

	}