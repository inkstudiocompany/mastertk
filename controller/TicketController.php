<?php

	namespace Application\Controller;

	use Model\ORM\Item;
	use Model\ORM\TipoItem;
	use Slim\Http\Response;

	class TicketController extends ControllerBase
	{
		public static function getById($id)
		{
			return Item::find($id);
		}

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

		public static function Save($params)
		{
			$id         = self::getInput($params, 'id');
			$tipoitem   = self::getInput($params, 'tipoitem');
			$estado     = self::getInput($params, 'estado');
			$prioridad  = self::getInput($params, 'prioridad');

			$item = new Item();
			if($id !== false) {
				$item = self::getById($id);
			}

			$item -> idItem       = $tipoitem;
			$item -> estadoActual = $estado;
			$item -> prioridad    = $prioridad;

			$item -> save();
			return $item;
		}

		public function editForm($idTicket)
		{
			$response = Item::with(
					//'proyecto',
					'asignado.usuario',
					//'estado',
					//'tipoItem',
					'transiciones'
			)->find($idTicket);

			if (true === is_null($response)) {
				$response = new Response();
				return $response->withRedirect($this->container->path('my_tickets', true));
			}

			$tipoItems = TipoItem::tipoItemsProyecto($response->proyecto->idProyecto)->get();

			$data_relations = [];

			$data_relations['tipo_items'] = [];
			foreach ($tipoItems As $tipoitem)
			{
				$data = [];
				$data['id']             = $tipoitem->idTipoItem;
				$data['descripcion']    = $tipoitem->descripcion;
				$data['estados']        = [];
				foreach ($tipoitem->estados()->get() As $key => $estado)
				{
					$data['estados'][$key] = [
						'id'      => $estado->idEstado,
						'nombre'  => $estado->nombreEstado,
					];
				}
				array_push($data_relations['tipo_items'], $data);
			}

			return $this->render('tickets/editar.html.twig', [
					'ticket'      => $response,
					'relaciones'  => $data_relations,
			]);
		}
	}