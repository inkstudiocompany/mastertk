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
				
				#Roles
				'roles' => '/roles',
				'new_rol' => '/roles/nuevo',
                'edit_rol' => '/roles/editar[/{id}]',
                'delete_rol' => '/roles/borrar[/{id}]',

				#Equipos
				'equipos' => '/equipos',
				'new_equipo' => '/equipos/nuevo',
                'edit_equipo' => '/equipos/editar[/{id}]',
                'delete_equipo' => '/equipos/borrar[/{id}]',

                #Usuarios
				'users' => '/usuarios',
				'new_user' => '/usuarios/nuevo',

				#Items
				'type_item' => '/tipoitem',
				'states' => '/estados',

				#Workflow
				'workflow' => '/workflow',
			];

		public static function getRoutes()
		{
			return self::$routes;
		}
	}