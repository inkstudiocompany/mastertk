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

			return $this->render('misproyectos/listado.html.twig', [
				'misproyectos' => $misproyectos
			]);

		}

	}