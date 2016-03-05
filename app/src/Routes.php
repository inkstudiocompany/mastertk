<?php

	namespace Application;

	class Routes
	{
		public static $routes = [
				'homepage' => '/home',
				'my_projects' => '/misproyectos',
				'my_tickets' => '/mistickets',
				'history' => '/historial',
				'admin_project' => '/proyectos',
				'new_project' => '/proyectos/nuevo',
				'equipment' => '/equipos',
				'roles' => '/roles',
				'new_rol' => '/roles/nuevo',
                'edit_rol' => '/roles/editar/:id',
				'users' => '/usuarios',
				'new_user' => '/usuarios/nuevo',
				'type_item' => '/tipoitem',
				'states' => '/estados',
				'workflow' => '/workflow',
			];

		public static function getRoutes()
		{
			return self::$routes;
		}
	}