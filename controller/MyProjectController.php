<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
    use Illuminate\Support\Facades\DB;
    use Model\ORM\Proyecto ;
    use Application\Controller\SecurityController;

	class MyProjectController extends ControllerBase
	{

		public function proyects()
		{
		
			$usuario = SecurityController::user();

            $lidero = Proyecto::with(['lider.rolPrincipal'])
                ->join('Equipo', 'Equipo.idProyecto', '=', 'Proyecto.idProyecto')
                ->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idEquipo', '=', 'Equipo.idEquipo')
                ->join('Rol', 'Rol.idRol', '=', 'UsuarioRolEquipo.idRol')
                ->where('Proyecto.idLider', '=', $usuario->id())
                ->select('Proyecto.*', 'Rol.nombreRol');

            $misproyectos = Proyecto::with(['lider.rolPrincipal'])
                ->join('Equipo', 'Equipo.idProyecto', '=', 'Proyecto.idProyecto')
                ->join('UsuarioRolEquipo', 'UsuarioRolEquipo.idEquipo', '=', 'Equipo.idEquipo')
                ->join('Rol', 'Rol.idRol', '=', 'UsuarioRolEquipo.idRol')
                ->where('UsuarioRolEquipo.idUsuario', '=', $usuario->id())
                ->union($lidero)
                ->select('Proyecto.*', 'Rol.nombreRol')
                ->get();

			return $this->render('misproyectos/listado.html.twig', [
				'misproyectos' => $misproyectos
			]);

		}

	}