<?php

	namespace Application\Controller;

	use Model\ORM\Item;
	use Model\ORM\TipoItem;
	use Slim\Http\Response;

	class TicketController extends ControllerBase
	{
		public function detalle($idTicket)
		{
			$response = Item::with('proyecto', 'asignado.usuario', 'estado', 'tipoItem', 'transiciones')->find($idTicket);

			if (true === is_null($response)) {
				$response = new Response();
				return $response->withRedirect($this->container->path('my_tickets', true));
			}

			return $this->render('tickets/detalle.html.twig', [
				'ticket'  => $response
			]);
		}

		public function editForm($idTicket)
		{
			$response = Item::with(
					//'proyecto',
					'asignado.usuario', 'estado', 'tipoItem', 'transiciones'
			)->find($idTicket);

			if (true === is_null($response)) {
				$response = new Response();
				return $response->withRedirect($this->container->path('my_tickets', true));
			}

			$tipoItems = TipoItem::tipoItemsProyecto($response->proyecto->idProyecto)->get();

			return $this->render('tickets/editar.html.twig', [
					'ticket'      => $response,
					'tipoitems'   => $tipoItems,
			]);
		}
	}