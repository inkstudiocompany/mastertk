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
				->join('Equipo', 'Proyecto.idProyecto', '=', 'Equipo.idProyecto')
				->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idEquipo', '=', 'Equipo.idEquipo')
				->join('Rol', 'UsuarioRolEquipo.idRol', '=', 'Rol.idRol')
				->join('Usuario', 'Usuario.idUsuario', '=', 'UsuarioRolEquipo.idUsuario')
				->where('Usuario.idUsuario', '=', $usuario->id())
				->get();

			return $this->render('misproyectos/listado.html.twig', [
				'misproyectos' => $misproyectos
			]);

		}

	}