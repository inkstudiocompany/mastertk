<?php

	namespace Application;

	class Routes
	{
		public static $routes = [
			'homepage'        => '/home',
			'my_projects'     => '/misproyectos',
			'my_tickets'      => '/mistickets',
			'history'         => '/historial',
			'admin_project'   => '/proyectos',
			'new_project'     => '/proyectos/nuevo',
			'equipment'       => '/equipos',

			#Security
			'login'           => '/login',
			'logout'          => '/logout',
			'auth'            => '/authenticate[/{email}/{password}]',

			#Message
			'message_confirm' => '/message/confirm',

			#Roles
			'roles'           => '/roles',
			'new_rol'         => '/roles/nuevo',
			'save_rol'        => '/roles/guardar',
      'edit_rol'        => '/roles/editar[/{id}]',
      'delete_rol'      => '/roles/borrar[/{id}]',

			#Equipos
			'equipos'         => '/equipos',
			'new_equipo'      => '/equipos/nuevo',
      'edit_equipo'     => '/equipos/editar[/{id}]',
      'delete_equipo'   => '/equipos/borrar[/{id}]',
			'rename_equipo'   => '/equipos/renombrar',

      #Usuarios
			'users'           => '/usuarios',
			'new_user'        => '/usuarios/nuevo',
			'edit_user'       => '/usuarios/editar[/{id}]',
			'delete_user'     => '/usuarios/borrar[/{id}]',
			'save_user'       => '/usuarios/guardar',
			'get_user'        => '/usuarios/get[/{id}]',
	    'find_user'       => '/usuarios/find[/{query}]',
	    'all_users'       => '/usuarios/all',

			#TipoItems
	    'tipoitems'       => '/tipoitems',
	    'new_tipoitem'    => '/tipoitems/nuevo',
			'states_tipoitem' => '/tipoitems/estados',
      'edit_tipoitem'   => '/tipoitems/editar[/{id}]',
      'delete_tipoitem' => '/tipoitems/borrar[/{id}]',

			#Items
			'item_detail'     => '/ticket/detalle[/{id}]',
			'edit_ticket'     => '/ticket/editar[/{id}]',


			#Workflow
			'workflow'        => '/workflow',

			#Proyectos
			'edit_project'              => '/proyectos/editar[/{id}]',
			'edit_project_teams'        => '/proyectos/equipos[/{id}]',
			'list_project_teams'        => '/proyectos/equipos-listar[/{id}]',
			'edit_project_item_types'   => '/proyectos/tipo-item[/{id}]',
			'edit_project_workflow'     => '/proyectos/workflow[/{id}]',
			'save_project'              => '/proyectos/guardar'


			];

		public static function getRoutes()
		{
			return self::$routes;
		}
	}