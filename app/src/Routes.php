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

				#Message
				'message_confirm' => '/message/confirm',
				
				#Roles
				'roles' => '/roles',
				'new_rol' => '/roles/nuevo',
				'save_rol' => '/roles/guardar',
                'edit_rol' => '/roles/editar[/{id}]',
                'delete_rol' => '/roles/borrar[/{id}]',

                #Usuarios
				'users' => '/usuarios',
				'new_user' => '/usuarios/nuevo',
				'save_user' => '/usuarios/guardar',
				'get_user' => '/usuarios/get[/{id}]',

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