<?php

	namespace Application\Controller;

	use Application\Controller\ControllerBase;
	use Model\ORM\Proyecto ;
	use Model\ORM\MyTicket as myticket;

	class MyTicketController extends ControllerBase
	{

		public function tickets()
		{

			$usuario = SecurityController::user();
			$mistickets = Proyecto::with(['equipos', 'lider'])
				->join('Item', 'Proyecto.idProyecto', '=', 'Item.idProyecto')
				->join('Estado', 'Item.estadoActual', '=', 'Estado.idEstado')
				->join('TipoItem', 'Item.idTipoItem', '=', 'TipoItem.idTipoItem')
				->join('Usuario', 'Usuario.idUsuario', '=', 'Item.responsable')
				->where('Usuario.idUsuario', '=', $usuario->id())
				->get();

			return $this->render('mistickets/listado.html.twig', [
				'mistickets' => $mistickets
			]);

#			proyecto item tipoitem usuario
		}


	}